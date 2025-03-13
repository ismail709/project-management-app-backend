<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // this function creates a project
    public function store(Request $request,User $user){
        $validated = $request->validate([
            'email' => 'email|max:255|unique:users,email',
            'password' => 'max:255|string|confirmed'
        ]);

        Auth::logout();
        
        $request->session()->flush();

    }

    // this function edits a project
    public function update(Request $request,Project $project){

    }

    // this function deletes a project
    public function destroy(Request $request,Project $project){
        
    }
}
