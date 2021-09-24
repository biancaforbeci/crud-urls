<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  public function register(Request $request)
  {
      $validatedData = $request->validate([
          'name' => 'required|max:55',
          'email' => 'email|required|unique:users',
          'password' => 'required|confirmed'
      ]);

      $validatedData['password'] = bcrypt($request->password);

      $user = User::create($validatedData);

      $accessToken = $user->createToken('authToken')->accessToken;

      return response([ 'user' => $user, 'access_token' => $accessToken]);
  }

  /**
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request){

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
      $user = Auth::user();
      $success['name'] =  $user->name;
      $success['access_token'] = auth()->user()->createToken('authToken')->accessToken;

      return response()->json([
        'status' => 'success',
        'response' => $success
      ]);
    } else {
      return response()->json([
        'status' => 'error',
        'data' => 'Unauthorized Access'
      ]);
    }
  }
}
