<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function users(Request $request){

        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'status' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        //check token is right or wrong

        $define_token  = 1234;
        $access_token = $request->token;

        if($define_token == $access_token){

            $user = User::get();

            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => 'User find successfully!',
                'user' => $user
            ],200);
            
        }else{
            return response()->json([
                'code' => 400,
                'status' => false,
                'errors' => 'Wrong Person'
            ], 400);
        }

        

    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 105,
                'status' => false,
                'message' => 'Invalid email or password'
            ], 200);
        }

        // Generate Bearer token (random string)
        $token = bin2hex(random_bytes(40));

        // Save token in remember_token column
        $user->remember_token = $token;
        $user->save();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ],200);
    }

    public function singup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'status' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password), 
        ]);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'User registered successfully!',
            'user' => $user
        ],200);
    }

}






