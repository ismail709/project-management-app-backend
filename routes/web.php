<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get("/logout/{user}",[ProjectController::class,'store'])->name("users.home");