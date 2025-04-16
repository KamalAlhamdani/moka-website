<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\User;
use Validator;
use App\Coupon;
use App\Carrier;
use App\Ceiling;
use App\GainType;

use Carbon\Carbon;
use App\GainMethod;
use App\userWallet;
use App\UserAddress;
use App\PointHistory;
use App\DeliveryPricing;
use App\Rules\CouponUsage;
use App\BalanceTransaction;
use App\Request as RequestM;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RequestResource;
use Dotenv\Validator as DotenvValidator;
use App\Notifications\RequestsNotification as Notification;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class RequestController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //ini_set('memory_limit', '-1');
        $data = $user->request()->where('requests.status', '!=', 'canceled')->Active()->orderBy("id", "desc")->get();
        //return response()->json(['success'=>true,'data'=> $data], $this-> successStatus);

        // dd($data);
        if ($data != null) {
            return new RequestResource($data);
        } else {
            return ['success' => true, 'data' => [], $this->successStatus];
        }
        // return response()->json(['success' => true, 'data' => $data ?? []], $this->successStatus);

        //return response()->json(['success' => true, 'data' => $data], $this->successStatus);
    }

    /**
     * Display a listing of the resource.
     * ref: https://stackoverflow.com/questions/5416437/syntax-error-unexpected-t-sl
     * @return \Illuminate\Http\Response
     */
    public function carrierIndex()
    {
        $user = Auth::user();
        //ini_set('memory_limit', '-1');
        $data = $user->request()->where(
            function ($query) {
                $query->where('requests.status', '!=', 'on_branch')
                    ->where('requests.status', '!=', 'canceled')
                    ->where('requests.receiving_type', 'delivery');
            }
        )->Active()->orderBy("id", "desc")->get();
        //return response()->json(['success'=>true,'data'=> $data], $this-> successStatus);

        // dd($data);
        if ($data != null)
            return new RequestResource($data);
        // return response()->json(['success' => true, 'data' => $data ?? []], $this->successStatus);

        //return response()->json(['success' => true, 'data' => $data], $this->successStatus);
    }

    /**
     * Display a listing of the all old request.
     *
     * @return \Illuminate\Http\Response
     */
    public function carrierOldIndex()
    {
        $user = Auth::user();
        $data = $user->request()->where(
            function ($query) {
                $query->where('requests.status', 'delivered')
                    ->orWhere('requests.status', 'on_branch')
                    ->where('requests.status', '!=', 'canceled')
                    ->where('requests.receiving_type', 'delivery');
            }
        )->Active()->orderBy("id", "desc")->get();

        if ($data != null) {
            return new RequestResource($data);
        }
    }

    /**
     * Display a listing of the all old request.
     *
     * @param Illuminate\Http\Request $request represents updated date
     *
     * @return \Illuminate\Http\Response
     */
    public function carrierOldDated(Request $request)
    {
        // Return all requests if updated_at param not set
        if (!isset($request->updated_at)) {
            return $this->carrierOldIndex();
        }

        // 1975-12-25
        // dd($request, Carbon::create($request->updated_at)->toDateString());

        $user = Auth::user();
        //ini_set('memory_limit', '-1');
        $data = $user->request()->where(
            function ($query) use ($request) {
                $query
                    ->where(
                        function ($q) {
                            $q->where('requests.status', 'delivered')
                                ->orWhere('requests.status', 'on_branch');
                        }
                    )
                    ->whereDate('requests.updated_at', $request->updated_at)
                    ->where('requests.status', '!=', 'canceled')
                    ->where('requests.receiving_type', 'delivery');
            }
        )->Active()

            ->orderBy("id", "desc")->get();

        if ($data != null) {
            return new RequestResource($data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request()->all());
        $user = Auth::user();
        $input = $request->all();
        //first check the cart before the other checks to use it in the other check
        $validator = Validator::make($input, [
            'cart_id' => [
                Rule::exists("carts", "id")->where(function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        if (!isset($input['cart_id'])) {
            $cart = Cart::where('user_id', $user->id)->where("status", 1)->firstOrFail();
            $input['cart_id'] = $cart->id;
        } else {
            $cart = Cart::FindOrFail($input['cart_id']);
        }

        // Check if the request price more than 2000 Rials
        $ceiling = Ceiling::first()->price ?? 1000;
        if ($cart->price_sum < $ceiling) {
            return response()->json(
                [
                    'success' => false, 'error' =>
                    [
                        'Cart price_sum is: '
                            . $cart->price_sum
                            . ', and it is less than '
                            . $ceiling
                            . '!'
                    ]
                ],
                401
            );
        }

        $wallet = array();
        $coupon = array();
        $delivery_price = array();
        $data = ["point" => 0];
        $wallet = userWallet::where('user_id', $user->id)->first();

        if (isset($input['delivery_price_id'])) {
            $delivery_price = DeliveryPricing::where('id', $input['delivery_price_id'])->first();
        }

        //if there is a balance for the user check if the balance is enough and the user not confirm the purchase
        if (isset($input['coupon_number'])) {
            $coupon = Coupon::where('number', $input['coupon_number'])->first();
        }

        $validator = Validator::make(
            $input, [
            'coupon_number' => [
                /* Check if coupon used for one time use for any user*/
               /*  Rule::exists("coupons", 'number')->where(
                    function ($query) {
                        $now = Carbon::now();
                        $query->where('start_date', '<=', $now)
                            ->where('end_date', '>=', $now)
                            ->where('status', 1)
                            ->where('uses_status', 0);
                    }
                ), */

                /* TODO: Check if current user use this coupon*/
                Rule::exists("coupons", 'number')->where(
                    function ($query) {
                        $now = Carbon::now();
                        $query->where('start_date', '<=', $now)
                            ->where('end_date', '>=', $now)
                            ->where('status', 1);
                    }
                ),
                new CouponUsage,
            ],
            'payment_type' => [
                'required', Rule::in(['cash', 'fromWallet','fromKuraimi']),
                function ($attribute, $value, $fail) use ($input, $cart, $wallet, $coupon) {
                    if ($value === 'fromWallet') {
                        $user = Auth::user();
                        if (!isset($wallet['current_balance']))
                            $fail("The user don't have a balance yet");

                        //if there is a balance for the user check if the balance is enough and the user not confirm the purchase
                        if (($cart['price_sum'] - ($coupon['price'] ?? 0))  >= $wallet['current_balance'])
                            $fail("The Wallet price is not enough");
                    }
                }
            ],
            'receiving_type' => ['required', Rule::in(['fromBranch', 'delivery'])],
            'deliver_location_id' => 'required',

            'cart_id' => [
                Rule::exists("carts", "id")->where(function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }),
            ],
        ]);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        // BySwadi:
        // if (!isset($delivery_price["id"]) && $input['receiving_type'] == 'delivery') {
        // return response()->json(
        //     ['success' => false, 'error' => 'There is no delivery price!'], 401
        // );
        // $input['delivery_price_id'] = $delivery_price["id"] ? $delivery_price["id"] : 1;
        // }
        if ($input['receiving_type'] == "delivery") {
            $input['address_id'] = $input['deliver_location_id'];
            //$input['delivery_price_id'] = $delivery_price["id"];
        } else {
            $input['branch_id'] = $input['deliver_location_id'];
            //$input['delivery_price_id'] = null;
        }

        DB::transaction(function () use ($input, $cart, $wallet, $coupon, $delivery_price, $user, &$data) {


            // change the way to use the coupon
            // To use this method, remove new CouponUsage, in validation
            // if (isset($coupon['id'])) {
            //     $input['coupon_id'] = $coupon["id"];
            //     $coupon->uses_status = 1;
            //     $coupon->save();
            // }

            // change the way to use the coupon
            if (isset($coupon['id'])) {
                $input['coupon_id'] = $coupon["id"];
            }

            /**
             * remove cach payment sum becouse the payment become from wallet or from cach just not both
             */
            // if ($input['payment_type'] == "fromWallet") {
            //     $cache_payment = abs(($cart['price_sum'] + ($delivery_price['price'] ?? 0)) - ($wallet->current_balance + ($coupon['price'] ?? 0)));
            // }
            // else {
            //     $cache_payment = abs(($cart['price_sum'] + ($delivery_price["price"] ?? 0)) - ($coupon['price'] ?? 0));
            // }
            // $input['cache_payment'] = $cache_payment;


            $requestM = RequestM::Create($input);
            $requestM->notify(new Notification($input));

            //add transaction and subtract from wallet
            if ($input['payment_type'] == "fromWallet") {
                $remain = $wallet->current_balance - ($cart['price_sum'] - ($coupon['price'] ?? 0));

                BalanceTransaction::create([
                    "request_id" => $requestM['id'],
                    'user_wallet_id' => $wallet['id'],
                    'amount' => $remain > 0 ? $cart['price_sum'] : $wallet['current_balance'],
                    'type' => "subtract"
                ]);
                $wallet->current_balance = $remain >= 0 ? $remain : 0;
                $wallet->save();
            }
            if ($input['payment_type'] == "fromKuraimi") {
                $remain = $cart['price_sum'] - ($coupon['price'] ?? 0);
                if (strlen($input['kuraimi_pinpass'])==0) {
                    return response()->json(['success' => false, 'error' => 'يجب عليك ادخال رقم التعريف الخاص بك في تطبيق الكريمي '], 401);
                }elseif (!is_numeric($input['kuraimi_pinpass'])) {
                    return response()->json(['success' => false, 'error' => 'رقم التعريف الخاص بك في تطبيق الكريمي يحب أن يكون رقم'], 401);
                }
                $json = $this->SendPayment($user->id,$cart->id,$remain,$input['kuraimi_pinpass']);
                if($json['Code']!='1'){
                    return response()->json(['success' => false, 'error' => $json['MessageDesc']], 401);
                }
            }

            //change the status of cart to make it as it is used
            $cart->status = 0;
            $cart->save();


            //check and add point
            // TODO: we use gain type id to fetch gain method so the id must much
            $gain_types = GainMethod::where('gain_type_id', 2)->orderBy("required_min_price", "DESC")->get();

            foreach ($gain_types as $gain_type) {

                if ($cart['price_sum'] >=  $gain_type['required_min_price']) {
                    $input = ['user_id' => $user->id, "gain_method_id" => $gain_type['id'], 'price' => $gain_type['price']];
                    $point = PointHistory::create($input);
                    $data['point'] =  $point->GainMethod->price;
                    break;
                }
            }
        });



        return response()->json(['success' => true, "data" => $data], $this->successStatus);
    }

    private function SendPayment($SCustID,$REFNO,$AMOUNT,$PINPASS){
//
//        $SCustID = request('SCustID');
//        $REFNO =rand(999,9999);
//        $AMOUNT = request('AMOUNT');
//        $PINPASS = request('PINPASS');

        $url = "https://213.202.4.205:12147/PHEPaymentAPI/EPayment/SendPayment";
        // $url = "https://213.202.4.205:443/PHEPaymentAPI/EPayment/SendPayment";
        // $url = base64_decode("aHR0cHM6Ly9jb25zdWx0Lmwuc2ZkLXllbWVuLm9yZy9TZW5kVGVzdA==");
        // $data = '{"SCustID":'.$SCustID.',"REFNO":'.$REFNO.',"AMOUNT":'.$AMOUNT.',"CRCY":"YER","MRCHNTNAME":"Merchant 1","PINPASS":'.$PINPASS.'}';
        $data ='{
    "SCustID": "'.$SCustID.'",
    "REFNO": "'.$REFNO.'",
    "AMOUNT": '.$AMOUNT.',
    "CRCY":"YER" ,
    "MRCHNTNAME": "Merchant 1",
    "PINPASS": "'.base64_encode($PINPASS).'"
}';
        $auth_code = 'U3VwcGxpZXIyMDIxOkFkbWluMTIz';

        $resp =  $this->sendCurl($url, $auth_code, $data);
        return $resp;
    }

    /**
     * @param string $url
     * @param string $auth_code
     * @param string $data
     * @return bool|string
     */
    private function sendCurl(string $url, string $auth_code, string $data)
    {

        $username = 'MOK01_UAT';
        $password = 'MOK@007';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic TU9LMDFfVUFUOk1PS0AwMDc=',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        $str= '';
        if (curl_error($curl)){
            $str = curl_error($curl);
            $info = curl_getinfo($curl);
        }

        curl_close($curl);
        if(strlen($str)){
            return $str;
        }
        return $response;

    }

    public function ReversePayment(){

        $SCustID = request('SCustID');
        $REFNO = request('REFNO');

        $url = "https://213.202.4.205:12147/PHEPaymentAPI/EPayment/ReversePayment";
        $url = base64_decode("aHR0cHM6Ly9jb25zdWx0Lmwuc2ZkLXllbWVuLm9yZy9TZW5kVGVzdA==");
        $data = '{"SCustID":'.$SCustID.',"REFNO":'.$REFNO.'}';
        $auth_code = 'U3VwcGxpZXIyMDIxOkFkbWluMTIz';

        $resp =  $this->sendCurl($url, $auth_code, $data);
        return [$resp];
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $req = RequestM::where('cart_id', $id)->with('requestItems.cartProductItems.product')->with('requestItems.cartOfferItems')->with('requestItems.cartSpecialItems')->get();

        return response()->json(['success' => true, 'data' => $req], $this->successStatus);
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
        $input = $request->all();
        $carrier = Carrier::where('id', Auth::user()->id)->first();
        $validator = Validator::make(
            $input,
            [
                'status' => ['required', Rule::in(['repair', 'ready', 'delivered', 'on_branch', 'on_the_way']), function ($carrier, $value, $fail) use ($input) {
                }],
            ]
        );
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }
        $data = ["point" => 0];
        $requestData = RequestM::Active()->findOrFail($id);
        $currentStatus = $requestData->status;
        $dliveryType = $requestData->receiving_type;
        DB::transaction(function () use ($input, $requestData, $currentStatus, $carrier, $dliveryType, &$data) {
            if ($input['status'] == 'ready') {
                if ($dliveryType == 'fromBranch') {
                    $requestData->status = 'done'; //completed
                } else {
                    $requestData->status = 'deliver';
                }
            } else {
                if ($requestData->status = 'on_branch') {
                    $carrier->status = 1;
                }
                $requestData->status = $input['status'];
            }
            $requestData->save();
            $carrier->save();
            // $user = Auth::user();
            // $count = $user->request()->whereRaw('MONTH(requests.created_at) = MONTH(NOW())')->where('requests.status', 'delivered')->count();
            // $gain_types = GainMethod::where('gain_type_id', 6)->orderBy("required_min_price", "DESC")->get();
            // foreach ($gain_types as $gain_type) {
            //     if ($count >=  $gain_type['required_min_price']) {
            //         $input = ['user_id' => $user->id, "gain_method_id" => $gain_type['id'], 'price' => $gain_type['price']];
            //         $point = PointHistory::create($input);
            //         $data['point'] =  $point->GainMethod->price;
            //         break;
            //     }
            // }
        });
        return response()->json(['success' => true, "data" => $data], $this->successStatus);
    }

    /**
     * Retrieve total count of delivered requests by carrier
     *
     * @return \Illuminate\Http\Response number total_orders
     */
    public function carriersRequests()
    {
        $user = Auth::user();
        $count = $user
            ->request()
            ->whereRaw('MONTH(requests.created_at) = MONTH(NOW())')->where(
                function ($query) {
                    $query->where('requests.status', 'on_branch')
                        ->where('requests.receiving_type', 'delivery');
                }
            )->count();
        $data =  [
            'total_orders' => $count,
        ];

        return response()->json(['success' => true, 'data' => $data], $this->successStatus);
    }



    /**
     * Cancel the request
     *
     * @param mixed $id request id
     *
     * @return void
     */
    public function cancel($id)
    {
        $input['id'] = $id;
        $validator = Validator::make(
            $input, [
                'id' => [
                    Rule::exists("requests", "id")
                        ->where(
                            function ($query) use ($id) {
                                $query->where('status', '!=', "canceled");
                                //->whereRaw('created_at < DATE_SUB(NOW(), INTERVAL 100 MINUTE)');
                            }
                        ),
                ],
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                ['success' => false, 'error' => $validator->errors()],
                401
            );
        }


        DB::transaction(
            function () use ($id) {
                $user = Auth::user();
                $request = User::find($user->id)
                            ->request()->Active()->findOrFail($id);


                $coupon = Coupon::where('id', $request['coupon_id'])->first();
                if (!empty($coupon)) {
                    $coupon->uses_status = 1;
                    $coupon->save();
                }


                $balance_transaction = BalanceTransaction::where(
                    'request_id', $request['id']
                )->first();

                $wallet = userWallet::where('user_id', $user->id)->first();
                if (!empty($balance_transaction) && !empty($wallet)) {
                    BalanceTransaction::create(
                        [
                            "request_id" => $request['id'],
                            'user_wallet_id' => $wallet['id'],
                            'amount' =>  $balance_transaction['amount'],
                            'type' => "refund"
                        ]
                    );
                    $wallet['current_balance']
                        = $wallet['current_balance']
                        + $balance_transaction['amount'];

                    $wallet->save();
                }

                //check and subtract point
                // because there is not request id in point history table
                // we rely on the created date.
                // to determine which one of point history of that user
                // is for this request by checking that the done in the same time
                $point_history = PointHistory::where('user_id', $user->id)
                                    ->whereRaw(
                                        "(created_at BETWEEN DATE_SUB(
                                                ?,
                                                INTERVAL 1 SECOND
                                            ) and ?)",
                                        [$request['created_at'],
                                        $request['created_at']]
                                    )->first();
                //$point_history = PointHistory::where('user_id',$user->id)->where("created_at",$request['created_at'])->first();

                if (!empty($point_history)) {
                    $point_history->delete();
                }

                $request->status = "canceled";
                $request->is_active = 2;
                $request->save();
            }
        );

        return response()->json(['success' => true], $this->successStatus);
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
        $request = User::find($user->id)->request()->Active()->findOrFail($id);

        $request->is_active = false;
        $request->save();

        return response()->json(['success' => true], $this->successStatus);
    }
}
