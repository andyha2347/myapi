<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\TableId;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $login =  $request->validate([
            'password' => 'required|string',
            'email' => 'required|string',
        ]);

        if(!Auth::attempt($login)){
            return response(['message' => 'invalid login info']);
        }
        // Creating a token without scopes...
        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        //return response()->json(["token_type" =>"Bearer","expires_in" => 2592000,"access_token" => $token]);
        $user =  Auth::user();
        $user->token = $accessToken;
        return response(['user' => $user]);

//        return response(['user' => Auth::user(),
//            'accessToken' => $accessToken
//            //,"expires_in" => 60
//        ]);
        // Creating a token with scopes...
        //  $token = $user->createToken('My Token', ['place-orders'])->accessToken;

    }//end login function
    //------------------------------
    public function register(Request $request)
    {
        $rules = [
            'name' => 'unique:users|required',
            'email'    => 'unique:users|required',
            'password' => 'required',
           // 'user_type' => 'required',
        ];

        $input     = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $name = $request->name;
        $email    = $request->email;
        $user_type = $request->user_type;
        $password = $request->password;
        $user     = User::create(['name' => $name, 'user_type' => $user_type, 'email' => $email, 'password' => Hash::make($password)]);
        userAddress::create(['user_id' => $user->id, 'name' => $user->name,  'address' => 'Enter Your Address']);
        TableId::create(['user_id' => $user->id]);

        if(!Auth::attempt(['email' => $email,'password' => $password])){
            return response(['message' => 'invalid login info']);
        }
        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        $user =  Auth::user();

        $user->token = $accessToken;
        return response(['user' => $user]);
    }
    //---------------------------------
}//end class
