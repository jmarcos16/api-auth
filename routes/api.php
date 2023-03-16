<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

Route::controller(RegisterController::class)->group(function () {
  Route::post('register', 'register');
  Route::post('login', 'login');
});

Route::post('/authenticate', [AuthController::class, 'auth']);

Route::controller(UserController::class)->group(function () {
  Route::get('users', 'index');
  Route::post('store', 'store');
  Route::get('show/{id}', 'show');
  Route::put('update/{id}', 'update');
  Route::delete('destroy/{id}', 'destroy');
});

Route::middleware('auth.sanctum')->group(function () {
  Route::resource('products', ProductController::class);
});
