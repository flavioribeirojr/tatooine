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

Route::get('/', function () {
    return redirect(config('app.base_route') .'/'. config('app.home'));
});

Route::group(['middleware' => 'security', 'prefix' => config('app.base_route')], function () {
    
    Route::get('/home', function () {
        return view('home.home');
    });
    
    Route::group(['prefix' => 'users', 'namespace' => 'Security'], function () {
        Route::get('/', 'UsersController@index');

        Route::get('/list', 'Async\UsersController@getUsers');
        Route::get('/permissions', 'Async\UsersController@getUserPermissions');
    });
});

Route::get('/login', function () {
    return view('login.login');
});

Route::post('/login', 'Security\LoginController@login');
Route::get('/logout', 'Security\LoginController@logout');
