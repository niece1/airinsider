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

//Posts by category
Route::get('categories/{category}', 'FrontendController@postsByCategory')->name('category');

//Posts by tag
Route::get('tags/{tag}', 'FrontendController@postsByTag')->name('tag');

//Posts by user
Route::get('users/{user}', 'FrontendController@postsByUser')->name('user');

//Dashboard
Route::group(['prefix'=>'dashboard', 'middleware'=>'auth'],function(){
	Route::resource('posts', 'PostController');
	Route::resource('categories', 'CategoryController');
	Route::resource('tags', 'TagController');
	Route::resource('roles', 'RoleController');
	Route::resource('permissions', 'PermissionController');
	//Delete Photo
    Route::get('deletePhoto/{id}', 'PostController@deletePhoto')->name('deletePhoto');
    //User 
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('/users/{user}', 'UserController@update')->name('users.update');
    Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');
    //Trash 
    Route::get('/trashed', 'PostController@trashed')->name('trashed');
    Route::delete('/expunge/{id}', 'PostController@expunge')->name('expunge');
    Route::post('/restore/{id}', 'PostController@restore')->name('restore');
});

//Subscription
Route::post('subscriptions/', 'SubscriptionController@store');

