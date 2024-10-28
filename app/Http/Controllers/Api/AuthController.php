<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'nullable|string|max:15|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'password'=> bcrypt($validatedData['password']),
            #'password' => Hash::make($validatedData['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'phone_number', 'password']);
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }
    


    public function logout(Request $request)
{
    try {
        // Get the token from the request
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        // Attempt to invalidate the token
        if (!JWTAuth::invalidate($token)) {
            return response()->json(['message' => 'Failed to invalidate token'], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    } catch (JWTException $e) {
        return response()->json(['message' => 'Logout failed', 'error' => $e->getMessage()], 500);
    }
}



//     public function logout(Request $request)
//     {

//         $token = JWTAuth::fromUser($request->only(['email','
//         ']));
//         $token->delete();
//         return response()->json(['token'=> null]);
//     }

}


