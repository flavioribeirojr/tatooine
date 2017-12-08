<?php

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

Route::group(['middleware' => 'security'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', function () {
            return view('master.master');
        }); 
    });
});

Route::get('/login', function () {
    return view('login.login');
});

Route::post('/login', 'Security\LoginController@login');
Route::post('/logout', 'Security\LoginController@logout');
