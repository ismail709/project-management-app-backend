<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    
    // this function creates a team
    public function store(Request $request){
        
    }
    
    // this function edits a team
    public function update(Request $request,Team $team){
        
    }
    
    // this function deletes a team
    public function destroy(Request $request,Team $team){
        
    }

    // this function returns the teams of the user
    public function getMembers(Request $request,Team $team){

    }

    // this function adds a member to a team
    public function addMembers(Request $request,Team $team){

    }

    // this function modifies a member role
    public function editMembers(Request $request,Team $team){

    }

    // this function removes a member from a team
    public function deleteMembers(Request $request,Team $team){

    }
}