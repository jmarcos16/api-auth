<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'permission:admin')->group(function () {
  Route::post('set-permission/{user_id}', [PermissionController::class, 'store']);
  Route::post('delete-permission/{user_id}', [PermissionController::class, 'destroy']);

  Route::post('update/{id}', [UserController::class, 'update']);
  Route::post('store', [UserController::class, 'store']);
  Route::delete('delete/{id}', [UserController::class, 'destroy']);
});


Route::middleware('auth:sanctum', 'permission:default')->group(function () {
  Route::get('user/{id}', [UserController::class, 'show']);
});

Route::post('authenticate', [AuthController::class, 'createToken']);
Route::get('users', [UserController::class, 'index']);
