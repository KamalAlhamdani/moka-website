<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BoxingType;
use App\Hospitality;
use App\Hospitality_Detail;
use App\Cart;
use App\CartDetail;
use App\ProductPrice;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Notifications\HospitalitiesNotification as Notification;
class HospitalityController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productPrice = ProductPrice::where('available', 1)->orderBy('id', 'desc')->paginate(12);
        return response()->json(['success'=>true,'data'=>  $productPrice], $this-> successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
            'date' => 'required|date',
            'total_price'=>'required',
            'details' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        $user = Auth::user();
        $input = $request->all();
        $boxing_type = BoxingType::findOrFail($input['boxing_type_id']);

        if (isset($boxing_type->price)) {

            $hospitality = Hospitality::create([
                'name' => $input['name'],
                'desc' => $input['desc'],
                'date' => $input['date'],
                'user_id' => $user->id,
                'boxing_type_id' => $input['boxing_type_id'],
                'total_price' => $input['total_price'],

                'quantity' => $input['quantity']

            ]);
            // $hospitality->notify(new Notification($input));
        }

        for ($i = 0 ; $i < count($input['details']) ; $i++) {
            $data = [
                'hospitality_id' => $hospitality->id,
                'product_price_id' => $input['details'][$i]['product_price_id'],
                'product_quantity' => $input['details'][$i]['product_quantity'],
            ];


            //dump($i);

            Hospitality_Detail::create($data);
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 1]
        );


        $cart_item = $this->cartAddHospitality(
            $hospitality->id,
            $cart->id,
            $input['quantity']
        );

        return response()->json(['success' => true, 'data' => $cart_item], $this->successStatus);
    }

    /**
     * Add the hospitality to cart,
     * Used BySwadi in website
     *
     * @param $hospitality_id int
     * @param $cart_id        int
     * @param $quantity       int
     *
     * @return App\CartDetail
     */
    public function cartAddHospitality($hospitality_id, $cart_id, $quantity)
    {
        return CartDetail::updateOrCreate(
            [
                'hospitality_id' => $hospitality_id,
                'cart_id' => $cart_id,
                'item_type' => 'hospitality'
            ],
            ['quantity' => $quantity]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hospitality  $hospitality
     * @return \Illuminate\Http\Response
     */
    public function show(Hospitality $hospitality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hospitality  $hospitality
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospitality $hospitality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hospitality  $hospitality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospitality $hospitality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hospitality  $hospitality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospitality $hospitality)
    {
        //
    }
}
