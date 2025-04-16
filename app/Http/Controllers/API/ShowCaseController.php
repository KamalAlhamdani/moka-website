<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\ShowCase;


class ShowCaseController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offer = ShowCase::orderBy('id', 'desc')->get();
        return response()->json(['success'=>true,'data'=>  $offer], $this-> successStatus);
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
     * @param  \App\ShowCase  $showCase
     * @return \Illuminate\Http\Response
     */
    public function show(ShowCase $showCase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShowCase  $showCase
     * @return \Illuminate\Http\Response
     */
    public function edit(ShowCase $showCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShowCase  $showCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShowCase $showCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShowCase  $showCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShowCase $showCase)
    {
        //
    }
}
