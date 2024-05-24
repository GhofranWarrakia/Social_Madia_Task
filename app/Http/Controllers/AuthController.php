<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $registerUserData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);

        Auth::login($user); 

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return response()->json([
            'message' => 'User Created',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $loginUserData['email'])->first();

        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials',
            ], 401);
        }

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return response()->json([
            "data" => $user,
            'access_token' => $token,
        ]);
    }
    public function logout(Request $request)
    {
       
        $request->auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'successfully Logged out',
        ]);
    }



}
