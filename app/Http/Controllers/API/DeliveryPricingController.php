<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryPricing;

class DeliveryPricingController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveryPricing = DeliveryPricing::orderBy('id', 'desc')->get();
        return response()->json(['success'=>true,'data'=>  $deliveryPricing], $this-> successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeliveryPricing  $deliveryPricing
     * @return \Illuminate\Http\Response
     */
    public function show($range)
    {
        $deliveryPricing = DeliveryPricing::where('range',$range)->get();
        return response()->json(['success'=>true,'data'=> $deliveryPricing], $this-> successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeliveryPricing  $deliveryPricing
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryPricing $deliveryPricing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeliveryPricing  $deliveryPricing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryPricing $deliveryPricing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeliveryPricing  $deliveryPricing
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryPricing $deliveryPricing)
    {
        //
    }
}
