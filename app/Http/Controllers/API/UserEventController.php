<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth; 
use Validator;
use dd;

use App\User;
use App\UserEvent;


class UserEventController extends Controller
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
        $data = UserEvent::where('user_id',$user->id)->get();
        return response()->json(['success'=>true,'data'=> $data], $this-> successStatus); 
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
            'date' => 'required', 
            'event_type_id' => 'required', 

        ]);
        if ($validator->fails()) { 
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }

        $user = Auth::user(); 
        $input = $request->all(); 

        $input['user_id']=$user->id;
        $user = UserEvent::create($input); 
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
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'date' => 'required', 
            'event_type_id' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }

        $user = Auth::user(); 
        $input = $request->all(); 
        $event = UserEvent::where('user_id',$user->id)->findOrFail($id);

        if(isset($request->note))
        {
            $event->note = $input["note"];
        }

        $event->name = $input["name"];
        $event->date = $input["date"];
        $event->event_type_id = $input["event_type_id"];
        

        $event->save();
        
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

        $deletedRows =  UserEvent::where('id', $id)->where('user_id',$user->id)->delete();

        return response()->json(['success'=>true], $this-> successStatus); 
    }
}
