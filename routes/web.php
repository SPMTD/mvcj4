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

Route::get('/', 'PostController@getWelcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/createpost', [
    'uses' => 'PostController@postCreatePost',
    'as' => 'post.create'
])->middleware('auth');

Route::get('/delete-post/{post_id}', [
    'uses' => 'PostController@getDeletePost',
    'as' => 'post.delete'
])->middleware('auth');

Route::post('/edit', [
    'uses' => 'PostController@postEditPost',
    'as' =>'edit'
])->middleware('auth');
