<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [App\Http\Controllers\Auth\ApiLoginController::class, 'login']);

Route::get('departaments', [App\Http\Controllers\Api\GeolocationsController::class, 'departaments']);
Route::get('municipalities/{id?}',[App\Http\Controllers\Api\GeolocationsController::class, 'municipalities']);

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('users', App\Http\Controllers\Api\UserController::class);
    Route::resource('emails', App\Http\Controllers\Api\EmailController::class);
});
