<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewUserNotification;
use App\Models\User;
use App\Mail\SendMail;
use Mail;
Use Auth;
use Validator;
use DB;



class AuthController extends Controller
{
    
    public function register(Request $request)
    {
      
        DB::beginTransaction();

        try{


            $data = $request->all();

            $validateData = Validator::make($data,[
                'name'=>'bail|required|string',
                'email'=>'required|email',
                'password'=>'required|confirmed',
                'role'=>'nullable|in:admin,officers',
            ]);

            $data['password'] =  bcrypt($request->password);

            $user = User::create($data);

            $accesstoken = $user->createToken('apitoken')->accessToken;

            if($user){
                Mail::to($user['email'])->send(new SendMail($user));
                //dd('email sent');
                
                $alladmin = User::where('role','admin')->get(); 
                //dd($alladmin);

                Notification::send($alladmin, new NewUserNotification($user));
            }

            // foreach($alladmin as $admin){
            //     Notification::route('mail' , $admin->admin) 
            //                 ->notify(new UserRegisterNotification($user)); 

            // }

                

            DB::commit();
            return response(['users'=>$user, 'access_token'=> $accesstoken]);


        }catch(\Exception $e){

            DB::rollback();
            return response()->json(['error'=>$e->getMessage()],500);
            
        } 
         

        

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
