<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth; 
use Validator;

use App\User;
use App\UserAddress;

class AddressController extends Controller
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
        $products = UserAddress::where('user_id',$user->id)->orderBy('created_at','DESC')->get();
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
            'name' => 'required', 
            'desc' => 'required', 
            'lat' => 'required',
            'long' => 'required', 

        ]);
        if ($validator->fails()) { 
                return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }
        $user = Auth::user(); 

        $input = $request->all(); 
        $input['user_id'] = $user->id;
        $cart = UserAddress::Create( $input);

        
        return response()->json(['success'=>true], $this-> successStatus); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
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
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'desc' => 'required', 
            'lat' => 'required',
            'long' => 'required', 

        ]);

        if ($validator->fails()) { 
                return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }

        $user = Auth::user(); 
        $input = $request->all(); 
        $address = UserAddress::where('user_id',$user->id)->findOrFail($id);

        $address->name = $input["name"];
        $address->desc = $input["desc"];
        $address->lat = $input["lat"];
        $address->long = $input["long"];

        $address->save();
        
        return response()->json(['success'=>true], $this-> successStatus); 
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

        $deletedRows =  UserAddress::where('id', $id)->where('user_id',$user->id)->delete();

        return response()->json(['success'=>true], $this-> successStatus); 
    }
}
