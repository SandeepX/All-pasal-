<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
Use Auth;
use Validator;


class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        

        $data = $request->all();

        $validateData = Validator::make($data,[
            'name'=>'bail|required|string',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);


       

        $data['password'] =  bcrypt($request->password);

        

        $user = User::create($data);

        $accesstoken = $user->createToken('apitoken')->accessToken;

        return response(['users'=>$user, 'access_token'=> $accesstoken]);

    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' =>'bail|required|email',
            'password'=>'required'
        ]);

        if(!auth()->attempt($login)){
            return response(['message'=>'credtiional doesnot match']);
        }

        $access_token = auth()->user()->createToken('apitoken')->accessToken;
        return response(['users' => auth()->user(), 'access_token'=>$access_token]);

    }

    public function logout()
    {

        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' =>'logout successfull'],200); 
        }else{
            return response()->json(['error' =>'logout unsuccessfulll'], 500);
        }
    }
}
