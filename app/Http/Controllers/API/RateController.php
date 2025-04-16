<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Rate;
use App\RateDetail;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RateController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Rate::with('rates')->paginate(10);
        return response()->json(['success'=>true,'data'=>  $products], $this-> successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_id' => 'required',
            'carrier_id' => 'required',
            'details'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        $user = Auth::user();
        $input = $request->all();
        $rate = Rate::create([
            'comment' => $input['comment'],
            'request_id' => $input['request_id'],
            'carrier_id' => $input['carrier_id'],
            'user_id' => $user->id,
        ]);

        for ($i = 0 ; $i < count($input['details']) ; $i++) {
            $data = [
                'rate_id' => $rate->id,
                'rate_type_id' => $input['details'][$i]['rate_type_id'],
                'rate' => $input['details'][$i]['rate'],
            ];

            RateDetail::create($data);
        }
        



        return response()->json(['success'=>true], $this-> successStatus);

    }

    /**
     * Get current average rate of logged in carrier
     * 
     * @return \Illuminate\Http\Response
     */
    public function showCarrierRate()
    {
        $data = [];
        $user = Auth::user();
        
        $carrier_rates_id = Rate::where('carrier_id', $user->id)
            ->whereRaw('MONTH(rates.created_at) = MONTH(NOW())')
            ->get('id')->toArray();

        $rates_count = RateDetail::whereIn('rate_id', $carrier_rates_id)
            ->get()->count();

        $rates_sum = RateDetail::whereIn('rate_id', $carrier_rates_id)
            ->get('rate')->sum('rate');

        if ($rates_count <= 0) {
            $data = ['average_rate' => 0];
            return response()->json(
                ['success'=>true, 'data' => $data], $this->successStatus
            );
        }

        $data = ['average_rate' => $rates_sum / $rates_count];

        return response()->json(
            ['success'=>true, 'data' => $data], $this->successStatus
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
