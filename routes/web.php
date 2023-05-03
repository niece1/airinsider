<?php

use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\ContactFormController;
use App\Http\Controllers\Frontend\LikeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SubscriptionController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CommentController as DashboardCommentController;
use App\Http\Controllers\Dashboard\ExportController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\PhotoController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SearchController as DashboardSearchController;
use App\Http\Controllers\Dashboard\SubscriptionController as DashboardSubscriptionController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\TrashController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

//Auth
Route::post('register', [RegisterController::class, 'register'])->middleware(['honey']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

//Laravel Socialite Facebook Google Github
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

//Post
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('categories/{category}', [PostController::class, 'postByCategory'])->name('posts.by.category');
Route::get('tags/{tag}', [PostController::class, 'postByTag'])->name('posts.by.tag');
Route::get('users/{user}', [PostController::class, 'postByUser'])->name('posts.by.user');
//Contact
Route::get('contact', [ContactFormController::class, 'create'])->name('contact');
Route::post('contact', [ContactFormController::class, 'store'])->middleware(['honey']);
//About
Route::get('about', AboutController::class)->name('about');
//Comments
Route::get('posts/{post}/comments', [CommentController::class, 'index']);
Route::get('comments/{comment}/replies', [CommentController::class, 'showReplies']);
Route::post('comments/{post}', [CommentController::class, 'store'])->middleware(['auth']);
//Likes
Route::post('likes/{entityId}/{type}', [LikeController::class, 'like'])->middleware(['auth']);
//Search
Route::get('search', [SearchController::class, 'search'])->name('search.index');
//Legal
Route::view('privacy-policy', 'frontend.legal.privacy-policy')->name('privacy-policy');
Route::view('terms-and-conditions', 'frontend.legal.terms-and-conditions')->name('terms-and-conditions');
Route::view('disclaimer', 'frontend.legal.disclaimer')->name('disclaimer');
Route::view('cookie-policy', 'frontend.legal.cookie-policy')->name('cookie-policy');

//Subscription
Route::group(['prefix' => 'subscription'], function () {
    //Redirect to subscribed page by clicking confirm link in subscription-confirmation mail
    Route::get('subscribed', [SubscriptionController::class, 'subscribed'])->name('subscribed');
    //Redirect to unsubscribed page by clicking unsubscribe link
    Route::get('unsubscribed', [SubscriptionController::class, 'unsubscribed'])->name('unsubscribed');
    //Update subscribed status by clicking confirm link in subscription confirmation mail
    Route::get('subscribe', [SubscriptionController::class, 'update'])->name('subscription.update');
    //Delete email from subscription list via link in the newsletter mail
    Route::get('unsubscribe', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');
});

//Dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    //Resource
    Route::resource('posts', DashboardPostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    //Expunge Photo
    Route::get('delete/{id}', [PhotoController::class, 'delete'])->name('photo.delete');
    //User
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    //Trash
    Route::get('trash', [TrashController::class, 'index'])->name('trash.index');
    Route::delete('delete/{id}', [TrashController::class, 'destroy'])->name('trash.destroy');
    Route::post('restore/{id}', [TrashController::class, 'restore'])->name('trash.restore');
    //Subscription
    Route::get('subscriptions', [DashboardSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::delete('subscriptions/{subscription}', [DashboardSubscriptionController::class, 'destroy'])->name('subscriptions.destroy');
    //Excel and Csv export
    Route::get('exportExcel', [ExportController::class, 'exportExcel'])->name('export.excel');
    Route::get('exportCsv', [ExportController::class, 'exportCsv'])->name('export.csv');
    //Comments list
    Route::get('comments', [DashboardCommentController::class, 'index'])->name('comments.index');
    Route::delete('comments/{comment}', [DashboardCommentController::class, 'destroy'])->name('comments.destroy');
    //Search
    Route::get('search', [DashboardSearchController::class, 'search'])->name('search');
});

/*For error page debug purpose
Route::fallback(function () {
    return view('errors.503');
});*/
