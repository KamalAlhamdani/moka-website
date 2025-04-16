<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;
use Validator;
class PasswordResetController extends Controller
{
    public $successStatus = 200;

    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',

        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => rand(100000,999999)
             ]
        );
       /*   if ($user && $passwordReset)
           $user->notify(
                new PasswordResetRequest($passwordReset->token)
            ); */
            return response()->json(['success'=>true,'data'=> $passwordReset], $this-> successStatus);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
        ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'token' => 'required|string'

        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        $user->password = Hash::make($request->password);
        $user->save();
        $passwordReset->delete();
      //  $user->notify(new PasswordResetSuccess($passwordReset));

        return response()->json(['success'=>true,'data'=> $user], $this-> successStatus);
        //return response()->json($user);
    }

    // TODO: test this in postman
    public function resetPass(Request $request)
    {
        //dd("l;sd;");
        $user = User::where('phone', $request->phone)->first();
        $user->password = Hash::make($request->password);
        $user->save();
    }

    public function change(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'old_password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'error'=>$validator->errors()], 401);
        }

        $user = Auth::user();
        if(Auth::guard('web')->attempt(['email' =>  $user->email, 'password' => request('old_password')])){
           $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['success'=>true,'data'=> $user], $this-> successStatus);
        }
        else{
            $error['massage'] = 'Unauthorized';
            return response()->json(['success'=>false,'error'=>$error], 401);
        }
    }
}
