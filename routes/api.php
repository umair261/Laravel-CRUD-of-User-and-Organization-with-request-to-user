<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|mhyaxbvkiohbpjmk
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('user_signup',[UserController::class,'user_signup']);
Route::post('user_login',[UserController::class,'user_login']);
Route::post('send-reset-password-email', [PasswordResetController::class, 'send_reset_password_email']);
Route::post('reset-password/{token}', [PasswordResetController::class, 'reset']);


Route::middleware('auth:sanctum')->group(function () {


    Route::delete('logout_user',[UserController::class,'logout_user']);


Route::delete('user_delete/{id}',[UserController::class,'user_delete']);
Route::put('user_update/{id}',[UserController::class,'user_update']);


Route::post('org_signup',[UserController::class,'org_signup']);
Route::post('org_login',[UserController::class,'org_login']);

Route::delete('org_delete/{id}',[UserController::class,'org_delete']);
Route::put('org_update/{id}',[UserController::class,'org_update']);

});

