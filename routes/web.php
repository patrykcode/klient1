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

Route::get('/', function() {
    return view('cms::index')->render();
})->name('dashboard');

Route::get('/settings', function() {})->name('settings')->middleware('can:settings.create');


Route::get('/login', 'testController@login')->name('login');

