<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/users', 'UserController@store');
Route::post('/users/verify', 'UserController@verify');

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/users', 'UserController@show');
    Route::post('/users/transfer', 'UserController@transfer');
});
