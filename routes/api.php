<?php

use App\Http\Controllers\ApiResultController;
use App\Http\Controllers\ApiSurveyController;
use App\Http\Controllers\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

// routes/api.php


//Route::get('/users', 'UserController@index');


//Route::get('/surveys/index', [ApiSurveyController::class, 'index'])->name('surveys.index');


Route::post('login', [ApiUserController::class, 'login']);
Route::post('logout', [ApiUserController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user',function(Request $request){
    return $request->user();
    Route::resource('/api_surveys', ApiSurveyController::class);
Route::resource('/results', ApiResultController::class);
});
//Route::get('user', [ApiUserController::class, 'user'])->middleware('auth:sanctum');