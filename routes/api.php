<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::controller(UserController::class)->group(function () {
  Route::get('users', 'index');
  Route::post('store', 'store');
  Route::get('user/{id}', 'show');
  Route::post('update/{id}', 'update');
  Route::delete('delete/{id}', 'destroy');
});


Route::post('set-permission/{user_id}', [PermissionController::class, 'store']);
Route::post('delete-permission/{user_id}', [PermissionController::class, 'destroy']);
