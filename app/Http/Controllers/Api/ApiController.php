<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ApiController extends Controller
{
    public function register(Request $request)
    {

        try 
        {
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                
            ]);
    
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ],422);
            }
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
    
            return response()->json([
                'status' => true,
                'message'=> 'User created Succesfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ],200);  
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=> $th->getMessage(),
            ],500);
        }
    }

    public function login(Request $request){
        try
        {
            $validateUser = Validator::make($request->all(),
            [
              
                'email' => 'required|email',
                'password' => 'required',
                
            ]);
    
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ],422);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'email & password doesn not match',
                    
                ],422);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message'=> $th->getMessage(),
            ],500);
    }

}

}



//Register, Login, Profile and Logout