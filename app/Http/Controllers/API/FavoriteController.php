<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth; 
use Validator;

use App\User;
use App\UserFavorite;

use App\Http\Resources\ProductCollection ;


class FavoriteController extends Controller
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
        $data = User::where('id',$user->id)->with('favorite')->first()->favorite;
       
        return new ProductCollection( $data);
        
        
       // return response()->json(['success'=>true,'data'=>  $products], $this-> successStatus); 
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
            'product_id' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }
        $user = Auth::user(); 

        $input = $request->all(); 
        $cart = UserFavorite::firstOrCreate(
            ['user_id' => $user->id,'product_id'=>$input["product_id"]]
        );

        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $user = Auth::user(); 

        $deletedRows =  UserFavorite::where('product_id', $product_id)->where('user_id',$user->id)->delete();

        return response()->json(['success'=>true], $this-> successStatus); 
    }
}
