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