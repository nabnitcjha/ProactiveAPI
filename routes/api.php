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
    // student-detail page route
    Route::get('student/{id}/profileOverview', 'StudentController@profileOverview');
    Route::get('student/{id}/teachers', 'StudentController@teachers');
    Route::get('student/{id}/groupDiscussion', 'StudentController@groupDiscussion');
    Route::get('student/{id}/Classes', 'StudentController@Classes');
    Route::put('student/{id}/changePassword', 'StudentController@changePassword');

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
    Route::post('timetable/{id}/resourceFile', 'ClassScheduleController@saveResourceFile');
});

// chat routes
// class-schedule routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {
    Route::get('chat', [App\Http\Controllers\ChatsController::class, 'index']);
    Route::get('messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
    Route::post('messages', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
});

