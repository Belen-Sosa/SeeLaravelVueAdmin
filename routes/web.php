<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CareerController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TypeQuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Models\Registration;
use Illuminate\Support\Facades\Route;

// No auth Routes
Route::get('/',[DashboardController::class,'index']);

//aplicamos el middleware para las rutas que necesitamos
Route::middleware(['auth:sanctum', config('jetstream.auth_session'),  'verified',
])->group(function () {
    //Auth Routes
    Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('/careers',CareerController::class);
    Route::resource('/options',OptionController::class);
    Route::resource('/questions',QuestionController::class);
    Route::resource('/registration',RegistrationController::class);
    Route::resource('/result' ,ResultController::class);
    Route::resource('/subjects',SubjectController::class);
    Route::resource('/surveys',SurveyController::class);
    Route::put('/surveys/{id}/state', [SurveyController::class, 'updateState'])->name('surveys.updateState');

    Route::resource('/teachers',TeacherController::class);
    Route::resource('/types_question',TypeQuestionController::class);
    Route::resource('/students',StudentController::class);
    
    Route::get('/students/{id}/editSubjects', [StudentController::class, 'editSubjects'])->name('students.editSubjects');
    Route::post('/students/{id}/{career_id}/{subject_id}/addSubjects', [RegistrationController::class, 'create_register'])->name('students.addSubjects');

    Route::delete('/students/{id}/destroyRegister', [StudentController::class, 'destroyRegister'])->name('students.destroyRegister');
    Route::resource('/administrators',AdministratorController::class);
    Route::resource('/users',UserController::class);


});
