<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Taste;


class TasteController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taste = Taste::get();
        return response()->json(['success'=>true,'data'=> $taste], $this-> successStatus);
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
     * @param  \App\Taste  $taste
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $taste = Taste::where('id',$id)->get();
        return response()->json(['success'=>true,'data'=> $taste], $this-> successStatus);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taste  $taste
     * @return \Illuminate\Http\Response
     */
    public function edit(Taste $taste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taste  $taste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taste $taste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taste  $taste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taste $taste)
    {
        //
    }
}
