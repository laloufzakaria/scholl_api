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

Route::group(['api' => 'v1'], function () {
    Route::post('/v1/login', 'PersonneController@personneogin');
    Route::get('/v1/logout', 'PersonneController@logout')->middleware('auth:api');
    Route::get('/v1/timetable', 'TimetableController@data');
    Route::get('/v1/timetable/{timetable}', 'TimetableController@show');
    Route::get('/v1/timetable/date/{date}', 'TimetableController@date');
    Route::get('/v1/teacher_subject/{teacher_subject_id}', 'TeacherSubjectController@show');
    Route::get('/v1/session/{session_id}', 'SessionController@show');
    Route::get('/v1/class/{class_id}', 'ClasseController@show');
    Route::get('/v1/subject/{subject_id}', 'SubjectController@show');
    Route::get('/v1/teacher/{teacher_id}', 'PersonneController@show');
    
});
