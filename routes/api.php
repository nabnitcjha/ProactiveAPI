<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

// student routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addStudent', 'StudentController@saveData');
    Route::get('getStudents/{allowPagination}', 'StudentController@index');

});

// teacher routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addTeacher', 'TeacherController@saveData');
    Route::get('getTeachers/{allowPagination}', 'TeacherController@index');

});

// subject routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addSubject', 'SubjectController@saveData');
    Route::get('getSubjects/{allowPagination}', 'SubjectController@index');

});

// class-schedule routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addTimetable', 'ClassScheduleController@saveData');
    Route::get('getTimetables/{allowPagination}', 'ClassScheduleController@index');
    Route::post('timetable/{id}/drag', 'ClassScheduleController@dragUpdate');

});