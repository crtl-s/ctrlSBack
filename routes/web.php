<?php

use App\Http\Controllers\EducationTypeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LearningTypeController;
use App\Http\Controllers\LearningTypeUserController;
use App\Http\Controllers\LessionController;
use App\Http\Controllers\LessionUserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TopicUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::controller(EducationTypeController::class)->group(function (){
    Route::get('/educationType', 'index');
    Route::post('/educationType', 'store');
    Route::get('/educationType/{id}', 'show');
    Route::put('/educationType/{id}', 'update');
    Route::delete('/educationType/{id}', 'destroy');
});

Route::controller(\App\Http\Controllers\AreaController::class)->group(function (){
    Route::get('/areas', 'index');
    Route::post('/areas', 'store');
    Route::get('/areas/{id}', 'show');
    Route::put('/areas/{id}', 'update');
    Route::delete('/areas/{id}', 'destroy');
});

Route::controller(GradeController::class)->group(function (){
    Route::get('/grades', 'index');
    Route::post('/grades', 'store');
    Route::get('/grades/{id}', 'show');
    Route::put('/grades/{id}', 'update');
    Route::delete('/grades/{id}', 'destroy');
});

Route::controller(LearningTypeController::class)->group(function (){
    Route::get('/learningTypes', 'index');
    Route::post('/learningTypes', 'store');
    Route::get('/learningTypes/{id}', 'show');
    Route::put('/learningTypes/{id}', 'update');
    Route::delete('/learningTypes/{id}', 'destroy');
});

Route::controller(LearningTypeUserController::class)->group(function (){
    Route::get('/learningTypeUsers', 'index');
    Route::post('/learningTypeUsers', 'store');
    Route::get('/learningTypeUsers/{id}', 'show');
    Route::put('/learningTypeUsers/{id}', 'update');
    Route::delete('/learningTypeUsers/{id}', 'destroy');
});

Route::controller(LessionController::class)->group(function (){
        Route::get('/lessions', 'index');
    Route::post('/lessions', 'store');
    Route::get('/lessions/{id}', 'show');
    Route::put('/lessions/{id}', 'update');
    Route::delete('/lessions/{id}', 'destroy');
});

Route::controller(LessionUserController::class)->group(function (){
    Route::get('/lessionUsers', 'index');
    Route::post('/lessionUsers', 'store');
    Route::get('/lessionUsers/{id}', 'show');
    Route::put('/lessionUsers/{id}', 'update');
    Route::delete('/lessionUsers/{id}', 'destroy');
    Route::get('/lessionUsers/setScore/{id}', 'setScore');

});

Route::controller(TopicController::class)->group(function (){
    Route::get('/topics', 'index');
    Route::post('/topics', 'store');
    Route::get('/topics/{id}', 'show');
    Route::put('/topics/{id}', 'update');
    Route::delete('/topics/{id}', 'destroy');
});

Route::controller(TopicUserController::class)->group(function (){
    Route::get('/topicUsers', 'index');
    Route::post('/topicUsers', 'store');
    Route::get('/topicUsers/{id}', 'show');
    Route::put('/topicUsers/{id}', 'update');
    Route::delete('/topicUsers/{id}', 'destroy');
});







require __DIR__.'/auth.php';
