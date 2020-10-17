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

Auth::routes();

//Frontend
Route::group(['namespace' => 'Frontend'], function () {
    //Posts
    Route::get('/', 'PostController@index')->name('home');
    Route::get('post/{post}', 'PostController@show')->name('post.show');
    Route::get('categories/{category}', 'PostController@postByCategory')->name('posts.by.category');
    Route::get('tags/{tag}', 'PostController@postByTag')->name('posts.by.tag');
    Route::get('users/{user}', 'PostController@postByUser')->name('posts.by.user');
    Route::get('contact', 'PostController@randomPost')->name('contact');
    //Contact
    Route::post('contact', 'ContactController@store');
    //About
    Route::get('about', 'AboutController')->name('about');
    //Comments
    Route::get('posts/{post}/comments', 'CommentController@index');
    Route::get('comments/{comment}/replies', 'CommentController@showReplies');
    Route::post('comments/{post}', 'CommentController@store')->middleware(['auth']);
    //Likes
    Route::post('likes/{entityId}/{type}', 'LikeController@like')->middleware(['auth']);
    //Subscription footer vue component
    Route::post('subscriptions', 'SubscriptionController@store');
});

//Laravel Socialite Facebook Google Github
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

//Dashboard
Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function () {
    //Resource
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    //Expunge Photo
    Route::get('delete/{id}', 'PhotoController@delete')->name('photo.delete');
    //User
    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('users/{user}', 'UserController@update')->name('users.update');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
    //Trash
    Route::get('trash', 'TrashController@index')->name('trash.index');
    Route::delete('delete/{id}', 'TrashController@destroy')->name('trash.destroy');
    Route::post('restore/{id}', 'TrashController@restore')->name('trash.restore');
    //Subscription
    Route::get('subscriptions', 'SubscriptionController@index')->name('subscriptions.index');
    Route::delete('subscriptions/{subscription}', 'SubscriptionController@destroy')->name('subscriptions.destroy');
    //Excel and Csv export
    Route::get('exportExcel', 'ExportController@exportExcel')->name('export.excel');
    Route::get('exportCsv', 'ExportController@exportCsv')->name('export.csv');
    //Comments list
    Route::get('comments', 'CommentController@index')->name('comments.index');
    Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.destroy');
    //Search
    Route::get('search', 'SearchController@search')->name('search');
});

/*For error page debug purpose
Route::fallback(function () {
    return view('errors.503');
});*/
