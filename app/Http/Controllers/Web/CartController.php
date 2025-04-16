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
namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Traits\CartTrait as CartHelper;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;


/**
 * Offer Class
 *
 * Used Links
 * URL[POST]: http://moka.api/api/cart
 * URL[GET] : http://moka.api/api/cart
 * URL[DEL] : http://moka.api/api/cart/{id}
 *
 * @constructor $request->headers->set('lang', App::getLocale());
 *
 * @category Web
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class CartController extends Controller
{

    /**
     * If you use this helper you don't need to specify the header 'lang'
     */
    use CartHelper;


    /**
     * Handle an incoming request headers.
     *
     * @param $request Illuminate\Http\Request
     *
     * @bySwadi Added to automatically set lang header
     */
    public function __construct(\Illuminate\Http\Request $request)
    {
        $request->headers->set('lang', App::getLocale());
        $this->middleware('auth:web');
    }

    /**
     * Get cart
     *
     * @return view
     */
    public function checkoutGet()
    {
        $cart = $this->cartGet();
        return view('_moka.Checkout.cart_items.index');
    }

    /**
     * Send cart
     *
     * @param $request Illuminate\Http\Request
     *
     * @return Redirect Illuminate\Support\Facades\Redirect
     */
    public function checkoutPost(Request $request)
    {
        $validatedData = $request->validate(
            [
                'quantity' => 'required|numeric|min:1',
            ]
        );
        if (auth()->user()->status == 3) {
            return Redirect()->back()->withErrors(
                ['product_error'=> auth()->user()->status_message]
            );
        }
        
        // TODO: check if there is a special product or hospitality in cart to throw an error
        !$validatedData ?: $this->cartPost($request);
        return Redirect()->back();
        //return view('_moka.Checkout.cart_items.index');
    }

    /**
     * Remove an item from the cart
     *
     * @param $id identifier of target cart item
     *
     * @return Redirect Illuminate\Support\Facades\Redirect
     */
    public function checkoutDelete($id)
    {
        $this->cartDelete($id);
        return Redirect()->back();
        // return view('_moka.Checkout.cart_items.index');
    }

    /**
     * Get Checkout Items page
     *
     * @return view
     */
    public function checkoutItems()
    {
        /* $cart = $this->cartGetItems();
        return view('_moka.Checkout.cart_items.index', compact('cart')); */

        // dump('getCartProductItems', \Cart::getCartProductItems());


        $user = \Auth::user();
        $userCart = \App\Cart::where('user_id', $user->id)
        ->with('cartProductItems.product')
        ->where('status', 1)
        ->first();
        // dump('user', $user->id, $user, $userCart);
        if ($userCart != null) {
            // TODO: test when the cart has 4 type of items
            $cart = new \App\Http\Resources\CartResource($userCart);

            // dd($cart);
            /* $tmp = [];
            foreach ($cart->cartProductItems as $item) {
                // $tmp[] .= $item->pivot->id; //cart item id for delete
                // foreach ($item->product->prices as $i) {
                    // $tmp[] .= $i;
                    // $tmp[] .= $i->unitName .' '. $i->id;
                // }
            }
            // return dd($tmp); */
            /* $tmp = [];
            foreach ($cart->cartOfferItems as $item) {
                // $tmp[] .= $item->pivot->id; //cart item id for delete
                $tmp[] .= $item;
                // foreach ($item->product->prices as $i) {
                    // $tmp[] .= $i;
                    // $tmp[] .= $i->unitName .' '. $i->id;
                // }
            }
            // return dd($tmp); */
            /* $tmp = [];
            foreach ($cart->cartSpecialItems as $item) {
                $tmp[] .= $item->name;
            }
            return dd($tmp);
            // return dd($cart->cartSpecialItems); */
            /* $tmp = [];
            foreach ($cart->cartHospitalityItems as $item) {
                // $tmp[] .= $item->pivot->id; //cart item id for delete
                $tmp[] .= $item;
                // foreach ($item->product->prices as $i) {
                    // $tmp[] .= $i;
                    // $tmp[] .= $i->unitName .' '. $i->id;
                // }
            }
            return dd($tmp); */

            /* \Cart::getCartSpecialItems() */
            $getCartProductItems     = $cart->cartProductItems;
            $getCartOfferItems       = $cart->cartOfferItems;
            $getCartSpecialItems     = $cart->cartSpecialItems;
            $getCartHospitalityItems = $cart->cartHospitalityItems;
            /* dd(
                $getCartProductItems,
                $getCartOfferItems,
                $getCartSpecialItems,
                $getCartHospitalityItems
            ); */
            return view(
                '_moka.Checkout.cart_items.index',
                compact(
                    'getCartProductItems',
                    'getCartOfferItems',
                    'getCartSpecialItems',
                    'getCartHospitalityItems'
                )
            );
        }

        /* TODO: remove these static functions from Cart Helper */
        /* dump(
            'getCartOfferItems',
            \Cart::getCartProductItems()
        );
        dump(
            'getCartOfferItems',
            \Cart::getCartOfferItems()
        );
        dump(
            'getCartSpecialItems',
            \Cart::getCartSpecialItems()
        );
        dump(
            'getCartHospitalityItems',
            \Cart::getCartHospitalityItems()
        ); */

        $getCartProductItems     = null;
        $getCartOfferItems       = null;
        $getCartSpecialItems     = null;
        $getCartHospitalityItems = null;

        return view(
            '_moka.Checkout.cart_items.index',
            compact(
                'getCartProductItems',
                'getCartOfferItems',
                'getCartSpecialItems',
                'getCartHospitalityItems'
            )
        );
    }

    /**
     * Get Checkout Delivery page
     *
     * @return view
     */
    public function checkoutDelivery()
    {
        $cart = $this->cartGet();
        return view('_moka.Checkout.delivery.index');
    }

    /**
     * Get Checkout Payment page
     *
     * @return view
     */
    public function checkoutPayment()
    {
        $cart = $this->cartGet();
        return view('_moka.Checkout.payment.index');
    }

    /**
     * Get Checkout Receipt page
     *
     * @return view
     */
    public function checkoutReceipt()
    {
        $cart = $this->cartGet();
        return view('_moka.Checkout.receipt.index');
    }
}
