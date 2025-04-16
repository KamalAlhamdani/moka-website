<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth; 
use Validator;

use App\Chat;

class ChatController extends Controller
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
        $products = Chat::where('user_id', $user->id)->orderBy('created_at',"DESC")->paginate(10);
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
            'text' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }

        $user = Auth::user(); 
        $input = $request->all(); 

        $input['user_id']=$user->id;
        $user = Chat::create($input); 
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
