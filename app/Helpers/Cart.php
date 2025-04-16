<?php
/**
 * Cart Utilities
 * php version 7.3.1
 *
 * @category Utilities
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
namespace App\Helpers;

use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Auth;

/**
 * Cart Utilities
 * 
 * Used Links
 * URL[POST]: http://moka.api/api/cart
 * URL[GET] : http://moka.api/api/cart
 * URL[DEL] : http://moka.api/api/cart/{id}
 * 
 * @constructor $request->headers->set('lang', App::getLocale());
 *
 * @category Utilities
 * 
 * @package Moka_APIs
 * @author  BySwadi <muath.ye@gmail.com>
 * @license IC https://www.infinitecloud.co
 * @link    Moka_Sweets https://www.mokasweets.com/
 */
class Cart
{
    /**
     * Handle an incoming request headers.
     *
     * @bySwadi Added to automatically set lang header
     */
    public function __construct()
    {
        // TODO: check if user logged in
        //\Auth::check() ?: abort('401');
    }

    /**
     * Get the number of items in the cart
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getItemCount() 
    {
        /* $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'GET', url('api/cart'), [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json',
                'lang' => app()->getLocale()
            ],
            ]
        );
        $cart = $response = $request_response->getBody()->getContents();
        $cart = json_decode($cart);
        return ! isset($cart->data->items_count) ? 0 : $cart->data->items_count; */
        

        $user = Auth::user();
        $userCart = \App\Cart::where('user_id', $user->id)
                        ->with('cartProductItems.product')
                        ->where('status', 1)
                        ->first();
        if ($userCart != null) {
            // TODO: test when the cart has items
            $cart = new \App\Http\Resources\CartResource($userCart);
            return count($cart->cartProductItems) 
                + count($cart->cartOfferItems) 
                + count($cart->cartSpecialItems)
                + count($cart->cartHospitalityItems);
        }

        return 0;
    }

    /**
     * Get the total price of items in the cart
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getTotalItemsPrice() 
    {
        /* 
        $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'GET', url('api/cart'), [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json',
                'lang' => app()->getLocale()
            ],
            ]
        );
        $cart =   $response = $request_response->getBody()->getContents();
        $cart = json_decode($cart);

        return ! isset($cart->data->price_sum) ?0: $cart->data->price_sum ; 
        */

        $cart = self::cartDetails();
        /* dd(
            $cart, 
            $cart->price_sum, 
            $cart->items_count, 
            $cart->items_count_web, 
            $cart->cart_product_items,
            $cart->cartProductItems
        ); */
        return $cart != null ? $cart->price_sum : 0;
    }

    /**
     * Get the products in the cart [okay]
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getCartProductItems()
    {
        /* 
        $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'GET', url('api/cart'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'lang' => app()->getLocale()
            ],
            ]
        );
        $cart = $response = $request_response->getBody()->getContents();
        $cart = json_decode($cart);

        return ! isset($cart->data->cart_product_items)
        ?[]: $cart->data->cart_product_items;

        $cart = response()->json(['success' => true, 'data' => $userCart ?? []], 200);
        $cart = json_decode($cart);
        return ! isset($cart->data->cart_product_items) ? [] : $cart->data->cart_product_items;  
        */

        $cart = self::cartDetails();
        /*// return $cart->cart_product_items; //null */
        return $cart != null ? $cart->cartProductItems : null;

        
    }

    /**
     * Get the products in the cart
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getCartOfferItems()
    {
        /* $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'GET', url('api/cart'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'lang' => app()->getLocale()
            ],
            ]
        );
        $cart = $response = $request_response->getBody()->getContents();
        $cart = json_decode($cart);

        return ! isset($cart->data->cart_offer_items)
        ?[]: $cart->data->cart_offer_items; 

        $cart = response()->json(['success' => true, 'data' => $userCart ?? []], 200);
        $cart = json_decode($cart);
        return ! isset($cart->data->cart_offer_items) ? [] : $cart->data->cart_offer_items; 
        */

        $cart = self::cartDetails();
        /*// return $cart->cart_offer_items; //null */
        return $cart != null ? $cart->cartOfferItems : null;
        
    }

    /**
     * Get the special products in the cart
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getCartSpecialItems()
    {
        return [];
        /* if (session('user_api_token') == null) {
            return [];
        }
        $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'GET', url('api/cart'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'lang' => app()->getLocale()
            ],
            ]
        );
        $cart = $response = $request_response->getBody()->getContents();
        $cart = json_decode($cart);

        return ! isset($cart->data->cart_special_items)
        ?[]: $cart->data->cart_special_items; 
        $cart = response()->json(['success' => true, 'data' => $userCart ?? []], 200);
        $cart = json_decode($cart);
        return ! isset($cart->data->cart_special_items) ? [] : $cart->data->cart_special_items; 
        */

        $cart = self::cartDetails();
        /*// return $cart->cart_special_items; //null */
        return $cart != null ? $cart->cartSpecialItems : null;
    }

    /**
     * Get the special products in the cart
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getCartHospitalityItems()
    {
        /* if (session('user_api_token') == null) {
            return [];
        }
        $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'GET', url('api/cart'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'lang' => app()->getLocale()
            ],
            ]
        );
        $cart = $response = $request_response->getBody()->getContents();
        $cart = json_decode($cart);

        return ! isset($cart->data->cart_hospitality_items)
        ?[]: $cart->data->cart_hospitality_items; */

        $cart = self::cartDetails();
        /*// return $cart->cart_hospitality_items; //null */
        return $cart != null ? $cart->cartHospitalityItems : null;
    }

    /*******************************************************************************
     * Cart details
     * Used by: [
     *      getTotalItemsPrice, 
     *      getCartProductItems, 
     *      getCartOfferItems, 
     *      getCartSpecialItems, 
     *      getCartHospitalityItems
     * ]
     * 
     * @return \App\Http\Resources\CartResource | null
     */
    public static function cartDetails()
    {
        $cart = null;
        $user = Auth::user();
        $userCart = \App\Cart::where('user_id', $user->id)
                        ->with('cartProductItems.product')
                        ->where('status', 1)
                        ->first();
        if ($userCart != null) {
            // TODO: test when the cart has items
            $cart = new \App\Http\Resources\CartResource($userCart);
        }
        
        return $cart;
    }

}
