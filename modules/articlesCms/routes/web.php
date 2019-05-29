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

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin', 'namespace' => 'Cms\Articles\Http\Controllers'], function () {

///Strony
    Route::group(['prefix' => 'articles', 'middleware' => 'can:articles.read'], function () {
        Route::get('', 'ArticlesController@index')->name('articles')->middleware('can:articles.read');
        Route::get('/update/{id}/{lang}', 'ArticlesController@update')->name('articles.update')->middleware('can:articles.create');
        Route::post('/update/{id}', 'ArticlesController@update')->name('articles.updatepost')->middleware('can:articles.update');
        Route::get('/pub/{id}', 'ArticlesController@pub')->name('articles.pub')->middleware('can:articles.update');
        Route::get('/delete/{id}', 'ArticlesController@delete')->name('articles.delete')->middleware('can:articles.delete');
        Route::post('/order', 'ArticlesController@order')->name('articles.order')->middleware('can:articles.update');
    });
});

