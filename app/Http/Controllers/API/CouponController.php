<?php

namespace App\Http\Controllers\API;

// use Validator;
use Illuminate\Support\Facades\Validator;
use App\Coupon;

use Carbon\Carbon;
use App\Rules\CouponUsage;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 




class CouponController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'number' => 'required|exists:coupons',
        ]);

        if ($validator->fails()) { 
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }

        //$user = Auth::user(); 
        //ini_set('memory_limit', '-1');

        $coupon = Coupon::where()->get();
    
        return response()->json(['success'=>true,'data'=> $coupon], $this-> successStatus); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input= $request->all();
        $validator = Validator::make($input, [ 
            'number' => [
                'required',
                'exists:coupons',
                Rule::exists('coupons')->where(function ($query) {
                    $now = Carbon::now();
                    $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now)->where('status', 1)->where('uses_status',0);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }
       
       // $user = Auth::user(); 

        $coupon = Coupon::where('number',$input['number'])->get();
    
        return response()->json(['success'=>true,'data'=> $coupon], $this-> successStatus); 
    }

    /**
     * Display the specified resource.
     * Check Validity of coupon
     *
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($coupon)
    {
        $input['number'] = $coupon;
        $validator = Validator::make($input, [
            'number' => [
                'required',
                'exists:coupons',
                Rule::exists('coupons')->where(function ($query) {
                    $now = Carbon::now();
                    $query->where('start_date', '<=', $now)
                        ->where('end_date', '>=', $now)->where('status', 1)->where('uses_status',0);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }

        $coupon = Coupon::where('number',$input['number'])->get();

        return response()->json(['success'=>true,'data'=> $coupon], $this-> successStatus);

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
        //
    }

    /**
     * Check Validity of coupon
     *
     * @param int $coupon
     */
    public function checkCoupon($coupon)
    {
        $input['number'] = $coupon;
        $validator = Validator::make($input, [
            'number' => [
                'required',
                'exists:coupons',
                Rule::exists('coupons')->where(function ($query) {
                    $now = Carbon::now();
                    $query->where('start_date', '<=', $now)
                        ->where('end_date', '>=', $now)->where('status', 1)->where('uses_status',0);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }

        $coupon = Coupon::where('number',$input['number'])->first();

        return response()->json(['success'=>true,'data'=> $coupon], $this-> successStatus);

    }

    
    /**
     * Check usage of this coupon by a user
     * 
     * @param int $coupon coupon number
     * 
     * @return array
     */
    public function checkCouponUsage($coupon)
    {
        // $now = Carbon::now();
        // dd(
                    
        //     Coupon::where('start_date', '<=', $now)
        //         ->where('number', '=', $coupon)
        //         ->where('end_date', '>=', $now)
        //         ->where('status', 1)->get()->count()
        // );
        $input['number'] = $coupon;
        /* $validator = Validator::make(
            $input, [
                'number' => [
                    'required',
                    'exists:coupons',
                    new CouponUsage,
                    Rule::exists('coupons')->where(
                        function ($query) {
                            $now = Carbon::now();
                            $query->where('start_date', '<=', $now)
                                ->where('end_date', '>=', $now)
                                ->where('status', 1);
                        }
                    ),
                ],
            ]
        ); */
        $validator = $this->validateCouponUsage($input);

        if ($validator->fails()) {
            return response()->json(
                ['success'=>false,'error'=>$validator->errors()], 
                401
            );
        }

        $coupon = Coupon::where('number', $input['number'])->first();

        return response()->json(
            ['success'=>true,'data'=> $coupon], 
            $this->successStatus
        );
    }

    /**
     * Validator for checkCouponUsage
     * 
     * @param array $input 
     * 
     * @return boolean
     */
    public function validateCouponUsage($input)
    {
        $validator = Validator::make(
            $input, [
                'number' => [
                    'required',
                    'exists:coupons',
                    new CouponUsage,
                    Rule::exists('coupons')->where(
                        function ($query) {
                            $now = Carbon::now();
                            $query->where('start_date', '<=', $now)
                                ->where('end_date', '>=', $now)
                                ->where('status', 1);
                        }
                    ),
                ],
            ]
        );

        return $validator;
    }
}
