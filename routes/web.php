<?php

use Illuminate\Support\Facades\Auth;
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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', function () {
		return view('home');
	});
	    Route::get('category', ['as' => 'pages.category', 'uses' => 'CategoryController@create']);
		Route::post('category/update', 'CategoryController@update');
		Route::put('category/store',  'CategoryController@store')->name('category.store');
		Route::get('category/destroy/{id}', 'SampleController@destroy');
		Route::get('category/index', 'CategoryController@index');
		
		Route::get('classe', ['as' => 'pages.classe', 'uses' => 'ClasseController@create']);
		Route::post('classe/update', 'ClasseController@update');
		Route::put('classe/store',  'ClasseController@store')->name('classe.store');
		Route::get('classe/destroy/{id}', 'ClasseController@destroy');
		Route::get('classe/index', 'ClasseController@index');
		
		Route::get('session', ['as' => 'pages.session', 'uses' => 'SessionController@create']);
		Route::post('session/update', 'SessionController@update');
		Route::put('session/store',  'SessionController@store')->name('session.store');
		Route::get('session/destroy/{id}', 'SessionController@destroy');
		Route::get('session/index', 'SessionController@index');
		
		Route::get('subject', ['as' => 'pages.subject', 'uses' => 'SubjectController@create']);
		Route::post('subject/update', 'SubjectController@update');
		Route::put('subject/store',  'SubjectController@store')->name('subject.store');
		Route::get('subject/destroy/{id}', 'SubjectController@destroy');
	    Route::get('subject/index', 'SubjectController@index');
		
		Route::get('personne', ['as' => 'pages.personne', 'uses' => 'PersonneController@create']);
		Route::post('personne/update', 'PersonneController@update');
		Route::put('personne/store',  'PersonneController@store')->name('personne.store');
		Route::get('personne/destroy/{id}', 'PersonneController@destroy');
		Route::get('personne/index', 'PersonneController@index');

		Route::get('teacher_subject', ['as' => 'pages.teacher_subject', 'uses' => 'TeacherSubjectController@create']);
		Route::post('teacher_subject/update', 'TeacherSubjectController@update');
		Route::put('teacher_subject/store',  'TeacherSubjectController@store')->name('teacher_subject.store');
		Route::get('teacher_subject/destroy/{id}', 'TeacherSubjectController@destroy');
		Route::get('teacher_subject/index', 'TeacherSubjectController@index');

		Route::get('timetable', ['as' => 'pages.timetable', 'uses' => 'TimetableController@create']);
		Route::post('timetable/update', 'TimetableController@update');
		Route::put('timetable/store',  'TimetableController@store')->name('timetable.store');
		Route::get('timetable/destroy/{id}', 'TimetableController@destroy');
		Route::get('timetable/index', 'TimetableController@index');

		
		
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

