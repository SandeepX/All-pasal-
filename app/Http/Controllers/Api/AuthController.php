<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewUserNotification;
use App\Models\User;
use App\Http\Resources\NotificationResource;
use App\Mail\SendMail;
use Mail;
Use Auth;
use Validator;
use DB;
use Carbon\Carbon;



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
                $when = Carbon::now()->addSeconds(10);
                // dd($when);
                
                foreach($alladmin as $admin){
                    $admin->notify((new NewUserNotification($user))->delay($when));
                }
                
                //Notification::send($alladmin, new NewUserNotification($user));
            }
            
            
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

    public function markAllread()
    {
        $data = auth()->user()->unreadNotifications()->select('id','data')->get();
        if(count($data)>0){

            foreach (auth()->user()->unreadNotifications as $notification) {
                $id = $notification->id;
                $status = auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
            }
            
            return response()->json(['success' =>'All notification read', 'data'=>$data],200); 
        }
        return response()->json(['message' =>'Notificaition already read'],200); 

        

    }

    public function getAllunread()
    {
      $data=  auth()->user()->unreadNotifications()->select('id','data','read_at')->get();
    
      $UnreadNotificationCount = count($data);
      //dd($UnreadNotificationCount);
      if($data){
          return response()->json(['message'=>'unread notificatin retrived successfully', 'data'=>$data],200);
      }

     
    }

    
    public function markasRead($id)
    {
        
        DB::beginTransaction();

        try{

            $userUnreadNotification = auth()->user()
                                            ->unreadNotifications
                                            ->where('id', $id)
                                            ->first();
           
            if($userUnreadNotification) {
                $userUnreadNotification->markAsRead();
     
                return response()->json(['message'=>'Notification Read Successfully','data'=>$userUnreadNotification],200);
                
    
            }else{
                return response()->json(['message'=>'Notification already read','data'=>null],200);
            }
            
            
        }catch(\Exception $e){
            
            return response()->json(['error'=>$e->getMessage()],500);
            DB::rollback();
        }
        
        DB::commit();
        
    }
}