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

//Laravel Socialite Facebook
//Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
//Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
//Laravel Socialite Github
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
