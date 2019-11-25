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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/post/{post}', 'FrontendController@show')->name('post.show');
Route::get('/contact', 'ContactController@create')->name('contact');
Route::post('contact', 'ContactController@store');

//Laravel Socialite Facebook Google Github
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

//Comments
Route::get('posts/{post}/comments', 'CommentController@index');
Route::get('comments/{comment}/replies', 'CommentController@show');
Route::post('comments/{post}', 'CommentController@store')->middleware(['auth']);

//Likes
Route::post('likes/{entityId}/{type}', 'LikeController@like')->middleware(['auth']);

