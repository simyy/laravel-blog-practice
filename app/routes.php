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

#article
Route::get('article', 'ArticleController@index');

#catalog
Route::get('/catalog', 'CatalogController@index');

#login
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@login');
Route::get('unlogin', 'LoginController@unlogin');

#edit
Route::get('edit', 'EditController@index');
Route::post('edit', 'EditController@newPost');

#manage
Route::get('manage', 'ManageController@index');
Route::get('manage/next', 'ManageController@getTitleList');
Route::post('manage/delete', 'ManageController@delete');

#set
Route::get('set', 'SetController@index');
