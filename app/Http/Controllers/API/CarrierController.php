<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Carrier;
//use App\CarrierFavorite;
use App\PointHistory;
use App\Image;




class CarrierController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){

      // dd( Auth::guard('carrier_api'));

        if(Auth::guard('carrier_web')->attempt(['email' => request('email'), 'password' => request('password')])){
            $carrier = Auth::guard('carrier_web')->user();
            $data['carrier'] =  $carrier;
            $data['carrier']['token'] =  $carrier->createToken('MyApp1')-> accessToken;


            return response()->json(['success'=>true,'data'=> $carrier], $this-> successStatus);
        }
        else{
            $error['massage'] = 'Unauthorized';
            return response()->json(['success'=>false,'error'=>$error], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:carriers,email',
            'phone' => 'required',
            'gender' => 'required',
            'password' => 'required',
            //'parent_points_account_num'=>'sometimes|exists:carriers,points_account_num',
            ]);
        if ($validator->fails()) {
                return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
            }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        //$input['points_account_num'] = Hash::make($input['password']);
        $carrier = Carrier::create($input);
     //   $carrier->points_account_num = rand ( 10 , 99 ) . $carrier->id . rand ( 10 ,99 );
        $carrier->save();

        $data['token'] =  $carrier->createToken('MyApp')->accessToken;
        $data['carrier'] =  $carrier;

      //  $input = [ 'carrier_id'=>$carrier->id ,"gain_method_id"=>1,'price'=>$gain_type['price']];
       // $point= PointHistory::create($input);
       // $data['point'] =  $point->GainMethod->price;

        return response()->json(['success'=>true,'data'=>$data], $this-> successStatus);
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function change_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image',

        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }

        $carrier = Auth::guard('carrier')->user();
        $input = $request->all();

        $imageName= Image::savePublicImage($request,'image','carriers');
        // $custom_folder_name = 'special_product/'.date('y-m-d');
        // $custom_file_name = time().'-'.$request->file('image')->getClientOriginalName();
        // $request->file('image')->storeAs($custom_folder_name, $custom_file_name,'public');

        $carrier->image = $imageName;
        $carrier->save();
        return response()->json(['success'=>true], $this-> successStatus);
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_image()
    {

        $carrier = Auth::guard('carrier')->user();

        $carrier->image = "carriers/avatar.jpg";
        $carrier->save();

        return response()->json(['success'=>true], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $carrier = Auth::user();
        return response()->json(['success'=>true,'data'=> $carrier], $this-> successStatus);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $carrierId = Auth::id();
        $validator= Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:carriers,email,'.$carrierId.',id',
            'phone' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }
        $carrierId = Auth::id();
        $carrier = Carrier::findOrFail($carrierId);
        $input = $request->all();

        $carrier->name=$input['name'];
        $carrier->email=$input['email'];
        $carrier->phone=$input['phone'];
        $carrier->gender=$input['gender'];
        $carrier->birth_date=$input['birth_date'];
        $carrier->address=$input['address'];


        $carrier->save();
        return response()->json(['success'=>true,'data'=>$carrier], $this-> successStatus);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrier $carrier)
    {
        //
    }

}

