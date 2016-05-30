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


use Illuminate\Support\Facades\Route;

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

Route::get('/auth', 'Api\UserController@auth');

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => 'auth:api'], function () {

    Route::group(['prefix' => 'workouts'], function () {
        Route::get('/', 'WorkoutController@index');
        Route::post('/', 'WorkoutController@store');
        Route::delete('/', 'WorkoutController@destroyAll');

        Route::get('/{id}', 'WorkoutController@show');
        Route::put('/{id}', 'WorkoutController@update');
        Route::delete('/{id}', 'WorkoutController@destroy');
    });

    Route::group(['prefix' => 'exercises'], function () {
        Route::get('/', 'ExerciseController@index');
        Route::post('/', 'ExerciseController@store');
        Route::delete('/', 'ExerciseController@destroyAll');

        Route::get('/{id}', 'ExerciseController@show');
        Route::put('/{id}', 'ExerciseController@update');
        Route::delete('/{id}', 'ExerciseController@destroy');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index');
        Route::post('/', 'UserController@store');
        Route::delete('/', 'UserController@destroyAll');

        Route::get('/{id}', 'UserController@show');
        Route::put('/{id}', 'UserController@update');
        Route::delete('/{id}', 'UserController@destroy');

    });

});

Route::get('random', function () {
    echo str_random(60);
});
