<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\CartDetail;
use App\SpecialProduct;
use App\ProductPrice;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\CartResource;
use dd;



class CartController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $userCart = Cart::where('user_id', $user->id)->with('cartProductItems.product')->where('status', 1)->first();
        if ($userCart != null)
        return new CartResource($userCart);
        return response()->json(['success' => true, 'data' => $userCart ?? []], $this->successStatus);

        //  return response()->json(['success'=>true,'data'=> $userCart??[]], $this-> successStatus);




    }

    public function index1(Request $request)
    {
        $user = Auth::user();
        $categories['products'] = Cart::with('cartProductItems')->get()->pluck('cartProductItems')->flatten();
        return response()->json(['success' => true, 'data' => $categories], $this->successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required',
            'quantity' => 'required',
            'type' => ['required', Rule::in(['product', 'special', 'offer', 'hospitality']), function ($attribute, $value, $fail) use ($input) {
                if ($value === 'special') {
                    $user = Auth::user();
                    $special_product = SpecialProduct::where('user_id', $user->id)->findOrFail($input['id']);
                    if($special_product->price == null)
                        $fail("The admin is not confirm the price yet");
                }
            }],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }
        $user = Auth::user();

        $input = $request->all();

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 1]
        );

        if ($input['type'] == "offer") {
            $cart_item = CartDetail::updateOrCreate(
                ['offer_id' => $input['id'], 'cart_id' => $cart->id, 'item_type' => $input['type']],
                ['quantity' => $input['quantity']]
            );
        } else if ($input['type'] == "special") {
            $cart_item = CartDetail::updateOrCreate(
                ['special_product_id' => $input['id'], 'cart_id' => $cart->id, 'item_type' => $input['type']],
                ['quantity' => $input['quantity']]
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
            $prices = ProductPrice::select('id')->where('product_id', $price->product_id)->get();
            //  print_r($prices);
            //  die;

            // This variable to store old value of cart item, and then use it in the new creation
            $item_created_at = CartDetail::where('cart_id',  $cart->id)->where('item_type',  $input['type'])
                ->whereIn('product_price_id', function ($query) use ($price) {
                    $query->select('id')->from('product_prices')
                        ->where('product_id', $price->product_id);
                }); //->first();

            /*CartDetail::where('cart_id',  $cart->id)->where('item_type',  $input['type'])
            ->whereIn('product_price_id', function ($query) use($price) {
                $query->select('id')->from('product_prices')
                ->where('product_id',$price->product_id);

            })->delete();*/

            $cart_item = CartDetail::updateOrCreate(
                [
                    /*'id'=>$item_created_at->id,'created_at'=>$item_created_at->created_at,*/
                    'product_price_id' => $input['id'],  'cart_id' => $cart->id, 'item_type' => $input['type']
                ],
                ['quantity' => $input['quantity'],]

            );

            //             $cart_item = CartDetail::all();
            //                 if($cart_item->product_id == $input['id'] and $cart_item->cart_id == $cart->id
            //                     and $cart_item->item_type == $input['type'] ){
            //                     //update
            //                     $cart_item1=CartDetail::find($input['id']);
            //                     $cart_item1->product_price_id=$input['price'];
            //                     $cart_item1->quantity=$input['quantity'];
            //
            //                     $cart_item1->save();
            //                 }
            //                 else{
            //                     //new
            //                     $cart_item1= new CartDetail();
            //                     $cart_item1->product_id=$input['id'];
            //                     $cart_item1->product_price_id=$input['price'];
            //                     $cart_item1->quantity=$input['quantity'];
            //                     $cart_item1->cart_id =$cart->id;
            //                     $cart_item1->item_type=$input['type'];
            //
            //                     $cart_item1->save();
            //                 }
        }
        return response()->json(['success' => true, 'data' => $cart_item], $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = Auth::user();
        $categories = Cart::where('user_id', $user->id)->where('status', 1)->first()->cartItems;
        return response()->json(['success' => true, 'data' => $categories], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = Auth::user();

        // $input = $request->all();

        $cart = Cart::where('user_id', $user->id)->where('status', 1)->firstOrFail();

        $cart_item = CartDetail::where('cart_id',  $cart->id)->findOrFail($id);
        $cart_item->delete();

        return response()->json(['success' => true], $this->successStatus);
    }
}
