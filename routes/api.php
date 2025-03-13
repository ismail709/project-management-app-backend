<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/auth', function () {
    return response()->json(["user" => auth()->user()]);
})->middleware('auth:sanctum');

Route::prefix("users")->group(function () {
    Route::get("/{user}/avatar", [UserController::class,"getAvatar"])->name('users.avatar');
});

// project routes
Route::prefix('projects')->group(function () {
    
});