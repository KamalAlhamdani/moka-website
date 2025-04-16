<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferCollection ;
use App\Offer;

class OfferController extends Controller
{
     public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offer = Offer::orderBy('id', 'desc')->with('offerProduct')->paginate(10);
        return new OfferCollection($offer);
        return response()->json(['success'=>true,'data'=>  $offer], $this-> successStatus);
    }

    public function related(Request $request,$id)
    {

        $offer = Offer::paginate(10);
        return response()->json(['success'=>true,'data'=>  $offer], $this-> successStatus);

      //  return response()->json(['success'=>true,"data"=> $d], $this-> successStatus);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //updated by sara mohammed
        $offer = Offer::where('id',$id)->with('offerProduct')->first();
        return response()->json(['success'=>true,'data'=>  $offer], $this-> successStatus);
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
