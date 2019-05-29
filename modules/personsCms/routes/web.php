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

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin', 'namespace' => 'Cms\Persons\Http\Controllers'], function () {

    //Zgloszenia
    Route::group(['prefix' => 'persons'], function () {
        Route::get('', 'PersonsController@index')->name('persons');
        Route::get('persons/excel', 'PersonsController@excel')->name('persons.excel');
//        Route::post('create', 'UsersController@create')->name('user.create')->middleware('can:user.create');
//        Route::get('reset/{id}', 'UsersController@reset')->name('user.reset')->middleware('can:user.update');
//        Route::post('update', 'UsersController@update')->name('user.update')->middleware('can:user.update');
//        Route::get('delete/{id}', 'UsersController@delete')->name('user.delete')->middleware('can:user.delete');
    });
});
