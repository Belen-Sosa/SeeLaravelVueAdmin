<?php
use App\Http\Controllers\ApiResultController;
use App\Http\Controllers\ApiSurveyController;
use App\Http\Controllers\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [ApiUserController::class, 'login']);
Route::post('logout', [ApiUserController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Define las rutas con middleware 'auth:sanctum' fuera del closure
Route::middleware('auth:sanctum')->group(function () {
    
    Route::resource('api_surveys', ApiSurveyController::class);
    
    Route::get('/api_surveys_user/{id}', [ApiSurveyController::class, 'index']);
      
    Route::get('/api/api_surveys/{id}', [ApiSurveyController::class, 'show']);


    Route::resource('results', ApiResultController::class);
    Route::post('/api_results/{id_user}/{id_survey}', [ApiResultController::class, 'store_survey']);
});
