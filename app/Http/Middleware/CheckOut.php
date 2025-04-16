<?php
/**
 * Laravel middleware
 * php version 7.3.1
 *
 * @category Middleware
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 *
 * @link Moka_Sweets https://www.mokasweets.com/
 */
namespace App\Http\Middleware;

use Cart;
use Closure;
use App\Ceiling;
use CheckoutUtilities;

/**
 * Handles checkout route steps logic
 *
 * @category Middleware
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class CheckOut
{
    /**
     * Handle an incoming request.
     *
     * @param $request \Illuminate\Http\Request
     * @param $next    \Closure
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Test purpose
        // dd(url()->current());
        // dd(url()->previous());
        // dd(route('web.checkout.items'));
        // dd($request->session()->get('_previous')['url']);
        // dd($request->session()->all());
        // dd($request->session()->has('secure_receiving_type'));
        // dd(\Cart::getItemCount());

        // Redirect back if user is in black list.
        if (auth()->user()->status == 3) {
            return Redirect()->back()->withErrors(
                ['product_error'=> auth()->user()->status_message]
            );
        }

        $current_url = url()->current();
        // In general allow if "items" step requested.
        if (route('web.checkout.items') == $current_url) {
            return $next($request);
        }

        // TODO: redirect to receipt page after order completed
        // Allow if "receipt" step requested and there is payment completion
        // in session.
        if (route('web.checkout.receipt') == $current_url
            && CheckoutUtilities::sessionIsOrderCompleted() == true
        ) {
            CheckoutUtilities::sessionRemoveOrderCompleted();
            return $next($request);
        }

        // If there is no items in the cart, redirect to "items" step.
        // if ($request->session()->get('cart_items_count') == 0) {
        if (Cart::getItemCount() == 0) {
            // return url()->previous() == route('web.checkout.payment')
            // ? redirect()->route('web.checkout.items')
            //     ->with(
            //         'cart_status',
            //         // ensure that request completed,
            //         // and send status as 'request_status'
            //         \Lang::get('_moka_checkout.your_order_is_completed')
            //     )
            // : redirect()->route('web.checkout.items')
            //     ->with('cart_status', \Lang::get('_moka_checkout.cart_is_empty'));

            return redirect()->route('web.checkout.items')
                ->with('cart_status', \Lang::get('_moka_checkout.cart_is_empty'));
        }

        // IF there is products in cart and their price less than 2000
        // Change this when modify
        // in RequestController@store#($cart->price_sum < 2000)
        $ceiling = Ceiling::first()->price ?? 1000;
        if (Cart::getTotalItemsPrice() < $ceiling) {
            return redirect()
                ->route('web.checkout.items')
                ->with(
                    'cart_status',
                    \Lang::get('_moka_checkout.cart_price_is_less_than_ceiling') .
                    ' '. $ceiling . '!'
                );
        }

        // Allow if "delivery" step requested and there is items in cart.
        if (route('web.checkout.delivery') == $current_url) {
            return $next($request);
        }

        // If there is no delivery method in "delivery", redirect to "delivery" step.
        if (! $request->session()->has('secure_receiving_type')
            || $request->session()->get('secure_receiving_type') == null
        ) {
            return redirect()
                ->route('web.checkout.delivery')
                ->with('cart_status', \Lang::get('_moka_checkout.no_delivery_info'));
        }

        // TODO: redirect to items page after order completed
        // And the request not completed
        if (route('web.checkout.receipt') == $current_url
            && CheckoutUtilities::sessionIsOrderCompleted() == false
        ) {
            return redirect()->route('web.checkout.payment')
                ->with(
                    'cart_status',
                    \Lang::get('_moka_checkout.completed_the_request')
                );
        }

        return $next($request);
    }
}
