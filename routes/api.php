<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\api\NewPasswordController;
use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\LoginController as ControllersLoginController;
use App\Http\Controllers\ProfileController as ControllersProfileController;

Route::post('register',[RegisterController::class, 'register']);
Route::post('login',[ControllersLoginController::class, 'login']);
Route::post('forgot-password',[NewPasswordController::class,'forgotPassword']);
Route::post('reset', [ResetPasswordController::class, 'reset']);

Route::middleware(['auth:sanctum'])->group(function(){

Route::get('user',[ControllersProfileController::class, 'userProfile']);
Route::post('upload-images',[ImageController::class,'uploadImages']);
Route::post('logout', [ControllersLoginController::class, 'logout']);
Route::delete('users/{user:uid}/delete',[ControllersProfileController::class, 'destroy']);
Route::delete('image/{uid}/delete',[ImageController::class, 'destroyImage']);
Route::get('get-images', [ImageController::class, 'getImages']);
Route::get('getUserImage/{uid}',[ImageController::class, 'userImage']);

});
// Route::get('/user', '', 'index')->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

