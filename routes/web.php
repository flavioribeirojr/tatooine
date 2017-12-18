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
        Route::get('/create', 'UsersController@create');
        Route::post('/store', 'UsersController@store');
        Route::get('/edit/{usrId}', 'UsersController@edit');
        Route::put('/update/{usrId}', 'UsersController@update');
        Route::delete('/delete/{usrId}', 'UsersController@delete');

        Route::get('/list', 'Async\UsersController@getUsers');
        Route::get('/permissions', 'Async\UsersController@getUserPermissions');
    });

    Route::group(['prefix' => 'profiles', 'namespace' => 'Security'], function () {
        Route::get('/', 'ProfilesController@index');
        Route::get('/create', 'ProfilesController@create');
        Route::post('/store', 'ProfilesController@store');
        Route::get('/edit/{prfId}', 'ProfilesController@edit');
        Route::put('/update/{prfId}', 'ProfilesController@update');
        Route::delete('/delete/{prfId}', 'ProfilesController@delete');

        Route::get('/list', 'Async\ProfilesController@getProfiles');
    });
});

Route::get('/login', function () {
    return view('login.login');
});

Route::post('/login', 'Security\LoginController@login');
Route::get('/logout', 'Security\LoginController@logout');
