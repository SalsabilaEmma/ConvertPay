<?php

namespace App\Http\Controllers;

use App\Http\Requests\login\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function index(LoginRequest $request)
    {
        $user = User::where('email',$request->email);
        //check email
        if(!$user->exists()) return response()->json(['message'=>'The email entered is incorrect'],422);
        
        $result = $user->first();
        //check password
        if(!Hash::check($request->password,$result->password)) return response()->json(['message'=>'the password entered is incorrect'],422);

        //check and redirect email verified
        if(!isset($result->email_verified_at)) return response()->json(['message'=>'email must verified','email'=>$result->email],302);

        $token = $result->createToken($result->email)->plainTextToken;

        return response()->json(['message'=>'success','data'=>["email"=>$result->email,"name"=>$result->name,'token'=>$token]]);
    }
}
