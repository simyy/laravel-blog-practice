<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

#index
Route::get('/', 'IndexController@index');
Route::get('index/articles/', 'IndexController@getNextPageArticle');

#login
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@login');

#edit
Route::get('edit', 'EditController@index');

#set
Route::get('set', 'SetController@index');
