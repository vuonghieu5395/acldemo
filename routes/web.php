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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function () {
    //module user
    Route::prefix('users')->group(function () {
        Route::get('/','UserController@index')->name('user.index');
        Route::get('/create','UserController@create')->name('user.add');
        Route::post('/create','UserController@store')->name('user.store');
            // edit user
        Route::get('/edit/{id}','UserController@edit')->name('user.edit');
        Route::post('/edit/{id}','UserController@update')->name('user.edit');

    });
    // module roles
    Route::prefix('roles')->group(function () {
        Route::get('/','RoleController@index')->name('role.index');
        Route::get('/create','RoleController@create')->name('role.add');
        Route::post('/create','RoleController@store')->name('role.store');
            // edit role
        Route::get('/edit/{id}','RoleController@edit')->name('role.edit');
        Route::post('/edit/{id}','RoleController@update')->name('role.edit');

    });
});
