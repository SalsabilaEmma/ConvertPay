<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\EmailVerifyRequest;
use App\Http\Requests\user\LupaPasswordRequest;
use App\Http\Requests\user\LupaPasswordVerifyRequest;
use App\Http\Requests\user\NewPasswordRequest;
use App\Http\Requests\user\UserStoreRequest;
use App\Mail\OtpEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function store(UserStoreRequest $request)
    {
        try {
            $token = Str::random(6);
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'remember_token'=>$token,
                'expired_token'=>Carbon::now()->addMinutes(10)
            ]);
            if(!isset($user->id)) return response()->json(["message"=>"something wen't wrong"],500);

            Mail::to($request->email)->send(new OtpEmail(['user'=>$request->name,'otp'=>$token]));
            return response()->json(["message"=>'success']);
        } catch (\Throwable $th) {
            return response()->json(["message"=>"something wen't wrong"],500);
        }
    }

    function emailVerify(EmailVerifyRequest $request)
    {
        try {
            $now = Carbon::now();
            $user = User::where('email',$request->email)
                    ->where('remember_token',$request->otp);
            //check user exists
            if(!($user->exists())) return response()->json(['message'=>'wrong otp code!'],500);
            $result = $user->first();
    
            //check user already use otp code
            if(isset($result->email_verified_at)) return response()->json(['message'=>'has been achieved'],500);
            
            //check expired otp code
            if($now > $result->expired_token) return response()->json(['message'=>'the otp code provided has expired'],500);
            
            //make user verified
            $user->update([
                'email_verified_at'=>$now
            ]);
            return response()->json(['message'=>'success']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>"something wen't wrong"],500);
        }
    }

    function lupaPassword(LupaPasswordRequest $request)
    {   
        try {
            $token = Str::random(6);
            $user = User::where('email',$request->email);
            $user->update([
                'remember_token'=>$token,
                'expired_token'=>Carbon::now()->addMinutes(10)
            ]);
            
            if($user->exists()){
                $result = $user->first();
                //send email
                Mail::to($request->email)->send(new OtpEmail(['user'=>$result->name,'otp'=>$token],"reset_password"));
            }

            return response()->json(['message'=>'success']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>"something wen't wrong"],500);
        }           

    }

    function lupaPasswordVerify(LupaPasswordVerifyRequest $request)
    {
        try {
            $user = User::where('email',$request->email)
                        ->where('remember_token',$request->otp);
            if(!($user->exists())) return response()->json(['message'=>'wrong otp code!'],500);
            
            $result = $user->first();
            #check if otp already use
            if($result->expired_token == null) return response()->json(["message"=>'has been achieved'],500);

            #check expired token
            if(Carbon::now() > $result->expired_token)return response()->json(['message'=>'the otp code provided has expired'],500);
            
            #null == already use
            $user->update([
                'expired_token'=>null
            ]);
    
            return response()->json(['message'=>'success']);
        } catch (\Throwable $th) {
            return response()->json(["message"=>"something wen't wrong"],500);
        }

    }

    function newPassword(NewPasswordRequest $request)   
    {
        try {
            $user = User::where('email',$request->email)
                    ->where('remember_token',$request->otp)
                    ->where('expired_token',null);
    
            if(!$user->exists())return response()->json(["message"=>"something wen't wrong"],500);
    
            $user->update([
               'password'=>Hash::make($request->password)
            ]);
    
            return response()->json(["message"=>"success"]);
        } catch (\Throwable $th) {
            return response()->json(["message"=>"something wen't wrong"],500);
        }
    
    }
}
