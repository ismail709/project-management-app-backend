<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // register function
    public function register(Request $request){
        // validate the request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        // create a user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // login the user
        Auth::login($user);

        // return the user
        return response()->json($user);
    }

    // login function
    public function login(Request $request){
        // validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // attemt to log the user in
        if(Auth::attempt($request->only('email','password'))){
            // regenerate the session
            $request->session()->regenerate();
            // return the user
            return response()->json(Auth::user());
        }

        // return the user
        return response()->json(['message' => 'Invalid login details'], 401);
    }

    // logout function
    public function logout(Request $request){
        // logout the user
        // Auth::logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        // return a message
        return response()->json(['message' => 'User logged out']);
    }
}
