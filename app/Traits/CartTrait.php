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
namespace App\Traits;

//use App\Request;
use dd;
use App\Cart;
use Validator;
use App\CartDetail;
use App\ProductPrice;
use App\SpecialProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\App;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\HospitalityController;

/**
 * Offer Class
 * 
 * Used Links
 * URL[POST]: http://moka.api/api/cart
 * URL[GET] : http://moka.api/api/cart
 * URL[DEL] : http://moka.api/api/cart/{id}
 *
 * @category Web
 * 
 * @package Moka_APIs
 * 
 * @author BySwadi <muath.ye@gmail.com>
 * 
 * @license IC infinitecloud.co
 * 
 * @link Moka_Sweets https://www.mokasweets.com/
 * 
 * @constructor $request->headers->set('lang', App::getLocale());
 * @bySwadi
 */
trait CartTrait
{
    /**
     * Success response status
     */
    protected $successStatus = 200;

    /**
     * It may be used to send header of lang
     * TODO: remove this constructor if not needed
     * 
     * @param $request Illuminate\Http\Request request of data
     * 
     * @return void
     */
    public function __construct(Request $request)
    {
        // $request->headers->set('lang', App::getLocale());
    }
    
    /**
     * Insert new item to the cart [Okay]
     * 
     * @param $request Illuminate\Http\Request request of data
     * 
     * @return void
     */
    public function cartPost( Request $request) 
    {
        $input = $request->all();
        $validator = Validator::make(
            $input, [
            'id' => 'required',
            'quantity' => 'required',
            'type' => [
                'required', Rule::in(
                    [
                        'product', 'special', 'offer', 'hospitality'
                    ]
                ), 
            function ($attribute, $value, $fail) use ($input) {
                if ($value === 'special') {
                    $user = Auth::user();
                    $special_product = SpecialProduct::where('user_id', $user->id)
                                            ->findOrFail($input['id']);
                    if ($special_product->price == null) {
                        $fail("The admin is not confirm the price yet");
                    }
                }
            }],
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                ['success' => false, 'error' => $validator->errors()],
                401
            );
        }

        $user = Auth::user();

        $input = $request->all();

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 1]
        );

        if ($input['type'] == "offer") {
            $cart_item = CartDetail::updateOrCreate(
                [
                    'offer_id' => $input['id'], 
                    'cart_id' => $cart->id, 
                    'item_type' => $input['type']
                ],
                [
                    'quantity' => $input['quantity']
                ]
            );
        } else if ($input['type'] == "special") {
            $cart_item = CartDetail::updateOrCreate(
                [
                    'special_product_id' => $input['id'], 
                    'cart_id' => $cart->id, 
                    'item_type' => $input['type']
                ],
                [
                    'quantity' => $input['quantity']    
                ]
            );
        } else if ($input['type'] == "hospitality") {
            $hospitality = new HospitalityController();
            $cart_item = $hospitality->cartAddHospitality(
                $input['id'],
                $cart->id,
                $input['quantity']
            );
        } else {

            $price = ProductPrice::where('id', $input['id'])->first();
            $prices = ProductPrice::select('id')
                ->where('product_id', $price->product_id)
                ->get();


            /**
             * This variable to store old value of cart item, 
             * and then use it in the new creation 
             */
            $item_created_at = CartDetail::where('cart_id',  $cart->id)
                ->where('item_type',  $input['type'])
                ->whereIn(
                    'product_price_id', 
                    function ($query) use ($price) {
                        $query->select('id')->from('product_prices')
                            ->where('product_id', $price->product_id);
                    }
                ); //->first();

            /*CartDetail::where('cart_id',  $cart->id)->where('item_type',  $input['type'])
            ->whereIn('product_price_id', function ($query) use($price) {
                $query->select('id')->from('product_prices')
                ->where('product_id',$price->product_id);

            })->delete();*/

            $cart_item = CartDetail::updateOrCreate(
                [
                    /*'id'=>$item_created_at->id,'created_at'=>$item_created_at->created_at,*/
                    'product_price_id' => $input['id'],  
                    'cart_id' => $cart->id, 
                    'item_type' => $input['type']
                ],
                ['quantity' => $input['quantity'],]
            );
        }
        return response()->json(
            ['success' => true, 'data' => $cart_item], 
            $this->successStatus
        );
        
        /* $cart = new CartController();
        return $cart->store($request); */
    }

    /**
     * Insert new item to the cart
     * Get cart form api
     * The route is dd(url('api/cart')); => "https://domain.example/api/cart"
     * 
     * @return void
     */
    public function cartGet() 
    {
        $user = Auth::user();

        $userCart = Cart::where('user_id', $user->id)
        ->with('cartProductItems.product')
        ->where('status', 1)
        ->first();

        if ($userCart != null) {
            return new CartResource($userCart);
        }
        //dd($userCart);
        return response()->json(
            ['success' => true, 'data' => $userCart ?? []], 
            $this->successStatus
        );

        /**
         * Old Code
         */
        if (session('user_api_token') == null) {
            return session(
                [
                    'cart_items_count' =>  0
                ]
            );
        }
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
        $cart = $response = $request_response->getBody()->getContents();
        $cart = json_decode($cart);
        session(
            [
            'cart_items_count' 
            => ! isset($cart->data->items_count)
            ? 0 : $cart->data->items_count]
        );
    }

    /**
     * Remove an item from the cart
     * 
     * @param $id identifier of target cart item
     * 
     * @return void
     */
    public function cartDelete($id)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 1)->firstOrFail();
        
        $cart_item = CartDetail::where('cart_id',  $cart->id)->findOrFail($id);
        
        $cart_item->delete();

        return response()->json(['success' => true], $this->successStatus);

        /* $cart = new CartController();
        return $cart->destroy($id); */
    }

    /**
     * Get cart offer item count [not used]
     * TODO: use this method when required
     * 
     * @param $id integer the offer identifier
     * 
     * @return integer
     */
    public function getOfferItemCount($id)
    {
        return 0;
    }

    /**
     * Checkout
     * Get Items
     * 
     * @return void
     */
    public function cartGetItems() 
    {
        $user = Auth::user();

        $userCart = Cart::where('user_id', $user->id)
        ->with('cartProductItems.product')
        ->where('status', 1)
        ->first();

        if ($userCart != null) {
            return new CartResource($userCart);
        }

        return response()->json(
            ['success' => true, 'data' => $userCart ?? []], 
            $this->successStatus
        );
    

        /** 
         * Old Code
         * ///////////////////////////////////////////////////////*/
        if (session('user_api_token') == null) {
            return session(
                [
                    'cart_items_count' =>  0
                ]
            );
        }
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
        
        session(
            [
            'cart_items_count' 
            => ! isset($cart->data->items_count) 
            ? 0 : $cart->data->items_count]
        );
        return $cart;
    }
}
