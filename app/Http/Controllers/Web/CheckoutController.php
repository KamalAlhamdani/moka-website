<?php 
/**
 * Http web routes
 * php version 7.3.1
 *
 * @category Web
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
namespace App\Http\Controllers\WEB;


use Illuminate\Http\Request;
use CheckoutUtilities;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\API\RequestController;

/**
 * Checkout Controller
 * 
 * @constructor $request->headers->set('lang', App::getLocale());
 *
 * @category Web
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class CheckoutController extends Controller
{
    /**
     * Handle an incoming request headers.
     *
     * @param $request Illuminate\Http\Request
     * 
     * @bySwadi Added to automatically set lang header
     */
    public function __construct(Request $request)
    {
        $request->headers->set('lang', App::getLocale());
    }

    /**
     * Get coupon validity
     * sessionAddUseCoupon function return true if the coupon added to the session
     * 
     * @param $coupon int
     * 
     * @return boolean
     */
    public function couponValidity(Request $coupon)
    {
        $coupon_utility = new CheckoutUtilities;
        $coupon_validity = $coupon_utility->sessionAddUseCoupon($coupon->coupon);
        return Redirect::back();
        return $coupon_validity;
    }

    /**
     * Get coupon validity
     * sessionAddUseCoupon function return true if the coupon added to the session
     * 
     * @return boolean
     */
    public function couponRemove()
    {
        $coupon_utility = new CheckoutUtilities;
        $coupon_utility->sessionRemoveUseCoupon();
        
        return Redirect::back();
    }

    /**
     * Add user note
     * 
     * @param string $note user note
     * 
     * @return boolean
     */
    public function noteAdd(Request $note)
    {
        $coupon_utility = new CheckoutUtilities;
        $coupon_utility->sessionAddNote($note->user_note);
        
        return Redirect::back();
    }

    /**
     * Remove user note
     * 
     * @return boolean
     */
    public function noteRemove()
    {
        $coupon_utility = new CheckoutUtilities;
        $coupon_utility->sessionRemoveNote();
        
        return Redirect::back();
    }

    /**
     * Add a delivery method
     * sessionAddDeliveryMethod function return back
     * 
     * @param $address type[fromBranch or delivery] and id
     * 
     * @return boolean
     */
    public function deliverAddress(Request $address)
    {
        $delivery_utility = new CheckoutUtilities;
        $delivery_utility->sessionAddDeliveryMethod($address->type, $address->id);

        return Redirect::back();
    }

    /**
     * Request order now
     * 
     * @param $request order now
     * 
     * @return boolean
     */
    public function requestOrder(Request $request)
    {
        // Check coupon validity
        if ($request->has('coupon_number')) {
            $coupon_controller = new CouponController();
            $input['number'] = request('coupon_number');
            $check_coupon_usage = $coupon_controller
            ->validateCouponUsage($input);
            // ->validateCouponUsage(request('coupon_number'));
            
            if ($check_coupon_usage->fails()) {
                //TODO: session destroy for coupon
                CheckoutUtilities::sessionRemoveUseCoupon();
                return redirect()->route('web.checkout.items')
                    ->with(
                        'cart_status', 
                        $check_coupon_usage->errors()->get('number')[0]
                    );
            }
        }
        // TODO: don't use session data
        $cart = new CheckoutUtilities;
        $request->merge($cart->getOrderData($request));
        
        $requestController = new RequestController;
        // dd($request->all());
        // dd($request->cart_items_count);
        /* Used in receipt page */
        $request->session()->put(
            'amount_to_be_paid', $request->amount_to_be_paid
        );
        $request->session()->put(
            'cart_items_count', $request->cart_items_count
        );
        $request->session()->put(
            'cart_price', $request->cart_price
        );
        if (isset($request->coupon_price)) {
            $request->session()->put(
                'coupon_price', $request->coupon_price
            );
        }
        if (isset($request->delivery_price)) {
            $request->session()->put(
                'delivery_price', $request->delivery_price
            );
        }
        $request->session()->put(
            'total_price', $request->total_price
        );

        // Check if request completed
        if ($requestController->store($request)) {
            $request->session()->put(
                'payment_type', $request->payment_type
            );
            $request->session()->put(
                'receiving_type', $request->receiving_type
            );
            $request->session()->put(
                'deliver_location_id', $request->deliver_location_id
            );
            $request->session()->put(
                'delivery_price_id', $request->delivery_price_id
            );
            $request->session()->put(
                'note', $request->note
            );

            CheckoutUtilities::sessionRemoveUseCoupon();
            CheckoutUtilities::sessionAddOrderCompleted();
        }
        // dump(session()->get('payment_type'));
        // dump(session()->get('receiving_type'));
        // dump(session()->get('deliver_location_id'));
        // dump(session()->get('delivery_price_id'));
        // dd(session()->get('note'));
        // dd(CheckoutUtilities::sessionIsOrderCompleted());
        return redirect()->route('web.checkout.receipt');
    }
}
