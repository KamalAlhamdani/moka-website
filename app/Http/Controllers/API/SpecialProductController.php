<?php

namespace App\Http\Controllers\API;

use App\Image;
use Validator;

use App\SpecialProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth; 

use App\Notifications\SpecialProductsNotification as Notification;

class SpecialProductController extends Controller
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
        $special_product = SpecialProduct::where('user_id',$user->id)->orderBy('created_at','DESC')->get();
        return response()->json(['success'=>true,'data'=>  $special_product], $this-> successStatus); 
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
            'image' => 'image',
            'date' => 'required'

        ]);
        if ($validator->fails()) { 
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }

        $user = Auth::user(); 
        $input = $request->all(); 


        // $custom_folder_name = 'special_product/'.date('y-m-d');
        // $custom_file_name = time().'-'.$request->file('image')->getClientOriginalName();
        // $request->file('image')->storeAs($custom_folder_name, $custom_file_name,'public');
        if(isset($request->image))
        {
            $imageName= Image::savePublicImage($request,'image','special_product');
            $input['image'] = $imageName;
            $input['show_case_id'] = null;
        }


        $input['user_id'] = $user->id;

        $user = SpecialProduct::create($input); 
        $user->notify(new Notification($input));
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
        $user = Auth::user(); 
        $special_product = SpecialProduct::where('user_id',$user->id)->findOrFail($id);
        return response()->json(['success'=>true,'data'=>  $special_product], $this-> successStatus); 
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
        ]);

        if ($validator->fails()) { 
                return response()->json(['success'=>false,'error'=>$validator->errors()], 401);            
        }

        $user = Auth::user(); 
        $input = $request->all(); 
        $special_product = SpecialProduct::where('user_id',$user->id)->findOrFail($id);

        $special_product->name = $input["name"];
        $special_product->desc = $input["desc"];

        $special_product->save();
        
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
        //
    }
}
