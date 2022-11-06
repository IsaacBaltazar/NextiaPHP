<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users_ModelController;
use App\Http\Controllers\BienesModelController;

Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});
Route::post('users/create',[Users_ModelController::class, 'create']);

Route::post('users/login',[Users_ModelController::class, 'login']);

Route::post('users/logout',[Users_ModelController::class, 'logout']);

Route::post('users/me',[Users_ModelController::class, 'me']);

Route::post('users/refresh',[Users_ModelController::class, 'refresh']);

Route::post('bienes/create',[BienesModelController::class, 'create']);