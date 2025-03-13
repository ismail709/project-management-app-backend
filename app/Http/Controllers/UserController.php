<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAvatar(Request $request,User $user){
        return response()->json($user->profile_image_path);
    }
}
