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

Route::group(['middleware' => ['web'], 'namespace' => 'Cms\Roles\Http\Controllers'], function () {
    Route::get('/adminpanel', /* function(){
              dd(bcrypt(''));
              } */ 'LoginController@showLoginForm')->name('login');
    Route::post('/adminpanel', 'LoginController@login')->name('login');

    Route::get('/logout', 'LoginController@logout')->name('logout');
});


Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin', 'namespace' => 'Cms\Roles\Http\Controllers'], function () {

    //Start
    Route::get('/start', 'StartController@index')->name('start');
    
    //Użytkownicy
    Route::group(['prefix' => 'users'], function () {
        Route::get('', 'UsersController@index')->name('user');
        Route::post('create', 'UsersController@create')->name('user.create')->middleware('can:user.create');
        Route::get('reset/{id}', 'UsersController@reset')->name('user.reset')->middleware('can:user.update');
        Route::post('update', 'UsersController@update')->name('user.update')->middleware('can:user.update');
        Route::get('delete/{id}', 'UsersController@delete')->name('user.delete')->middleware('can:user.delete');
    });

    //Role
    Route::group(['prefix' => 'roles'], function () {
        Route::post('/create', 'RolesController@create')->name('roles.create');
        Route::get('/role/{id}', 'RolesController@show')->name('roles.read')->middleware('can:roles.read');
        Route::post('/update', 'RolesController@update')->name('roles.update')->middleware('can:roles.update');

        Route::post('/user-role-save/{id}', 'UsersController@roleSave')->name('user.save')->middleware('can:user.edit');
        Route::post('/user-role-file-save/{id}', 'UsersController@filesToRoleSave')->name('user.savefiles')->middleware('can:user.edit');
    });
});
