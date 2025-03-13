<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // this function creates a task
    public function store(Request $request){

    }

    // this function edits a task
    public function update(Request $request,Task $task){

    }

    // this function deletes a task
    public function destroy(Request $request,Task $task){

    }

    // this function assign a task to a user
    public function assignTo(Request $request,Task $task,User $user){
        
    }

    // this function dismass a user from a task
    public function dismissFrom(Request $request,Task $task,User $user){
        
    }

    // this function add a comment to a task
    public function addComment(Request $request,Task $task){
        
    }

    // this function edit a comment of a task
    public function editComment(Request $request,Task $task){
        
    }

    // this function delete a comment of a task
    public function deleteComment(Request $request,Task $task){
        
    }
}
