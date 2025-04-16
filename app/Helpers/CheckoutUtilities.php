<?php
/**
 * User Profile
 * php version 7.3.1
 *
 * @category Utilities
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
namespace App\Helpers;

use App\Cart;

use \Illuminate\Http\Request;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CouponController;

/**
 * UserProfile
 * 
 * @constructor $request->headers->set('lang', App::getLocale());
 *
 * @category Utilities
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class CheckoutUtilities
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
     * Get the addresses of current user
     * How to use: ```\App\Globals\UserProfile::getUserAddresses()->data[0]->name```
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getUserAddresses() 
    {
        $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'GET', url('api/address'), [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept' => 'application/json',
                    'lang' => app()->getLocale()
                ],
            ]
        );
        
        $address = $response = $request_response->getBody()->getContents();

        return json_decode($address);
        // return ! $address->data ? [] : $address->data;
    }

    /**
     * Get the selected user address
     * How to use: ```\App\Globals\UserProfile::getSelectedUserAddress($id)```
     *
     * @param int $id id of location
     * 
     * @return string user address name
     */
    public static function getSelectedUserAddress($id) 
    {
        // dd($id);
        $addresses = self::getUserAddresses();
        foreach ($addresses->data as $item) {
            if ($item->id == $id) {
                return $item->name;
            }
        }

        return Lang::get('_moka_checkout.choose_location');
    }

    /**
     * Get the price of delivery to selected user address 
     * How to use: ```\App\Globals\UserProfile::getSelectedUserAddressPrice($id)```
     *
     * @param int $id id of location
     * 
     * @return string user address name
     */
    public static function getSelectedUserAddressPrice($id) 
    {
        //TODO: return the price not the name
        $addresses = self::getUserAddresses();
        foreach ($addresses->data as $item) {
            if ($item->id == $id) {
                return $item->name;
            }
        }

        return Lang::get('_moka_checkout.choose_location');
    }

    /**
     * Add an address for current user
     * How to use: ```\App\Globals\UserProfile::getUserAddresses()->data[0]->name```
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function addUserAddresses() 
    {
        // TODO: create new address for the user
        return 0;
    }

    /**
     * Get the addresses of branches
     * How to use:
     * ```\App\Globals\UserProfile::getUserAddresses()->data[0]->name```
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getBranchesAddress() 
    {
        $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'GET', url('api/branch'), [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept' => 'application/json',
                    'lang' => app()->getLocale()
                ],
            ]
        );
        
        $address = $response = $request_response->getBody()->getContents();

        return json_decode($address);
        // return ! $address->data ? [] : $address->data;
    }

    /**
     * Get the selected branch address
     * How to use: ```\App\Globals\UserProfile::getSelectedBranchAddress($id)```
     *
     * @param int $id id of branch
     * 
     * @return string user branch name
     */
    public static function getSelectedBranchAddress($id) 
    {
        // dd($id);
        $addresses = self::getBranchesAddress();
        foreach ($addresses->data as $item) {
            if ($item->id == $id) {
                return $item->name;
            }
        }

        return Lang::get('_moka_checkout.choose_branch');
    }

    /**
     * Get the status of user balance
     * How to use:
     * ```\App\Globals\UserProfile::getUserAddresses()->data[0]->name```
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getUserBalance() 
    {
        $token = session('user_api_token');
        $client = new Client();
        $request_response = $client->request(
            'POST', url('api/point_history/convert'), [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept' => 'application/json',
                    'lang' => app()->getLocale()
                ],
            ]
        );
        
        $balance = $response = $request_response->getBody()->getContents();

        return json_decode($balance);
        // return ! $address->data ? [] : $address->data;
    }

    /**
     * ******************************************************************************
     * Checkout Session data                                                        *
     * ******************************************************************************
     * 
     * TODO: Create checkoutController to handle all checkout request 
     *       that related to session adding
     */

    /**
     * Add a coupon to session if user check it at items page of checkout,
     * session = coupon number if it available
     * session = 0 if coupon not available
     * 
     * Note: you will check validity of coupon in the checkoutController
     * 
     * @param int $id coupon identifier
     * 
     * @return int session
     */
    public static function sessionAddUseCoupon($id)
    {

        //TODO: use this function in checkoutController with specific route
        $check_coupon = new CouponController;
        // $coupon_validity = $check_coupon->checkCoupon($id);
        $coupon_validity = $check_coupon->checkCouponUsage($id);
        $coupon_number = $coupon_validity->getOriginalContent();
        session(
            [
                'coupon_number' 
                => $coupon_number['success'] 
                ? $coupon_number['data']->number
                : 0
            ]
        );
        session(
            [
                'coupon_price'
                => $coupon_number['success']
                ? $coupon_number['data']->price
                : 0
            ]
        );

        // session('secure_coupon_number') 
        // used in order to ensure that the user can't 
        // modify session data except using website process
        session(
            [
                'secure_coupon_number'
                => $coupon_number['success']
                ? $coupon_number['data']->number
                : 0
            ]
        );
        return session('coupon_number');
    }

    /**
     * Add a note to session
     * 
     * @param string $note user note
     * 
     * @return int session
     */
    public static function sessionAddNote($note)
    {

        //TODO: sanitize the note
        session(
            [
                'user_note' 
                => $note
            ]
        );
        // session('secure_user_note') 
        // used in order to ensure that the user can't 
        // modify session data except using website process
        session(
            [
                'secure_user_note' 
                => $note
            ]
        );
        return session('user_note');
    }

    /**
     * Remove a note from session
     * 
     * @return int session
     */
    public static function sessionRemoveNote()
    {

        //TODO: sanitize the note
        session(
            [
                'user_note' 
                => 0
            ]
        );
        // TODO: session('secure_user_note') 
        // used in order to ensure that the user can't 
        // modify session data except using website process
        session(
            [
                'secure_user_note' 
                => 0
            ]
        );
        return session('user_note');
    }

    /**
     * Remove a coupon from session 
     * 
     * @return int session
     */
    public static function sessionRemoveUseCoupon()
    {
        session(
            [
                'coupon_number' 
                => 0
            ]
        );
        session(
            [
                'coupon_price'
                => 0
            ]
        );
        // session('secure_coupon_number') 
        // used in order to ensure that the user can't 
        // modify session data except using website process
        session(
            [
                'secure_coupon_number' 
                => 0
            ]
        );
        return session()->forget(['coupon_number', 'coupon_number']);
    }

    /**
     * Add a delivery method
     * 
     * @param $type string
     * @param $id   int
     * 
     * @return int session
     */
    public static function sessionAddDeliveryMethod($type, $id)
    {
        session()->forget(['receiving_type', 'deliver_location_id']);
        session(
            [
                'receiving_type' 
                => $type
                ? $type
                : 0 ,
                'deliver_location_id' 
                => $id
                ? $id
                : 0
            ]
        );
        // session('secure_receiving_type')
        // session('secure_deliver_location_id')
        // used in order to ensure that the user can't 
        // modify session data except using website process
        session(
            [
                'secure_receiving_type' 
                => $type
                ? $type
                : 0 ,
                'secure_deliver_location_id' 
                => $id
                ? $id
                : 0
            ]
        );
        if ($type == 'delivery') {
            // TODO: (if needed) Add delivery price
            session(
                [
                    'delivery_price' 
                    => 0
                ]
            );
        }
        
        return session('receiving_type').'-'.session('deliver_location_id');
    }

    /**
     * Get cart id
     * 
     * @param \Illuminate\Http\Request $request not used in API controller
     * @param int                      $id      not used current user identifier
     * 
     * @return int current user cart identifier
     */
    public static function getCartId(Request $request, $id = null)
    {
        $cart = new CartController;
        $cart_id = isset($cart->index($request, $id)->id) 
        ? $cart->index($request, $id)->id : 0;
        session(
            [
                'secure_cart_id'    
                => $cart_id
            ]
        );
        return $cart_id;
    }

    /**
     * Get Order data
     * 
     * @param \Illuminate\Http\Request $request not used in API controller
     * 
     * @return array
     */
    public static function getOrderData(Request $request)
    {
        /*
        "payment_type"       
        "receiving_type"     
        "deliver_location_id"
        "confirm"            
        "coupon_number"      
        "cart_id"            
        "delivery_price_id"  
        "note"               
        */
        $total_price = \Cart::getTotalItemsPrice() -
                        Session::get('coupon_price') +
                        Session::get('delivery_price');

        $order['_token']              = $request->_token;
        $order['payment_type']        = $request->payment_type;
        $order['receiving_type']      = session('receiving_type');
        $order['deliver_location_id'] = session('deliver_location_id');
        $order['confirm']             = "true"; // get confirmation from the use
        
        if (session('coupon_number') !== null && session('coupon_number') != 0) { 
            $order['coupon_number'] = session('coupon_number');
        }
            
        $order['cart_id']             = (string) self::getCartId($request);
        $order['delivery_price_id']   = '1'; // TODO: get the price identifier
        $order['note']                = session('user_note');
        
        /* Used in receipt page */
        $order['cart_items_count']    = $request->cart_items_count;
        $order['cart_price']          = \Cart::getTotalItemsPrice();
        if (Session::get('coupon_price') != 0) {
            $order['coupon_price']    = session('coupon_price');
        }
        if (Session::get('receiving_type') == 'delivery' && Session::get('delivery_price') != 0) {
            $order['delivery_price']  = session('delivery_price');
        }
        $order['total_price']         = $total_price;
        
        return $order;
    }

    /**
     * Add a delivery method
     * 
     * @return void session
     */
    public static function sessionAddOrderCompleted()
    {
        session()->forget(['order_completed']);
        session(
            [
                'order_completed' 
                => 1 ,
            ]
        );
        return session('order_completed');
    }

    /**
     * Remove a delivery method
     * 
     * @return void session
     */
    public static function sessionRemoveOrderCompleted()
    {
        session(
            [
                'order_completed' 
                => 0 ,
            ]
        );
        return session()->forget(['order_completed']);
    }
  
    /**
     * Get request status if request completed successfully
     * 
     * @return boolean
     */
    public static function sessionIsOrderCompleted()
    {
        return Session::get('order_completed') == 1 ? true : false;
    }

    /**
     * Clear session data after request completed successfully
     * 
     * @return boolean
     */
    public static function clearSession()
    {
        return 1;
        // return Session::flush();
    }


}