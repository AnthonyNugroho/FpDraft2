<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\UserModel;


class AuthController extends Controller
{

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'username'=>'required',
      'name' => 'required',
      'email' => 'required|string|email',
      'password' => 'required',
    ]);

    if($validator -> fails())
    {
      return response()->json($validator->messages(),401);
    }

    $user = UserModel::create([
      'username'=>$request->input('username'),
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password')),
    ]);

    return response([
      'status' => 'success',
      'data' => $user,
    ], 200);
  }


  public function login(Request $request)
     {
         $validator = Validator::make($request->all(), [
           'email' => 'required|email',
           'password' => 'required',
         ]);
         if($validator->fails()) {
             return response()->json(['success'=> false, 'error'=> $validator->messages()]);
         }

         $credentials = $request->only('email','password');

         try {
             // attempt to verify the credentials and create a token for the user
             if (!$token = JWTAuth::attempt($credentials)) {
                 return response()->json(['success' => false, 'error' => 'email or password is incorrect.'], 401);
             }
         } catch (JWTException $e) {
             // something went wrong whilst attempting to encode the token
             return response()->json(['success' => false, 'error' => 'cannot create token.'], 500);
         }
         // all good so return the token
         $user = UserModel::where('email', $request->email)->first();
         return response()->json(['success' => true, 'data'=> [ 'token' => $token ], 'username'=> $user->username]);
     }

  public function logout(Request $request) {

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }


}
