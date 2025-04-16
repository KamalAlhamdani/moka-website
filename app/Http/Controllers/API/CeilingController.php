<?php

namespace App\Http\Controllers\API;

use App\Ceiling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;


class CeilingController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Ceiling  $ceiling
     * @return \Illuminate\Http\Response
     */
    public function show(Ceiling $ceiling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ceiling  $ceiling
     * @return \Illuminate\Http\Response
     */
    public function edit(Ceiling $ceiling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ceiling  $ceiling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'price' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }
        $ceiling = Ceiling::where('id',$id)->findOrFail($id);
        $ceiling->price = $input["price"];
        $ceiling->save();

        return response()->json(['success'=>true], $this-> successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ceiling  $ceiling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ceiling $ceiling)
    {
        //
    }
}
