<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'workouts'], function () {
    Route::get('/', 'WorkoutController@index');
    Route::get('/create', 'WorkoutController@create');
    Route::post('/store', 'WorkoutController@store');
});


Route::group(['prefix' => 'exercises'], function () {
    Route::get('/', 'ExerciseController@index');
    Route::get('/create', 'ExerciseController@create');
    Route::post('/store', 'ExerciseController@store');
});

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'workouts'], function () {
        Route::get('/', 'WorkoutController@index');
    });
});
