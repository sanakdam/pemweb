<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::auth();

Route::group(['middleware' => ['web']], function () {
    Route::get('/upload', function () {
        return view('upload');
    })->name('upload');

    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'logout',
    ]);

    Route::get('/dashboard', [
        'uses' => 'PostController@getDashboard',
        'as' => 'home',
        'middleware' => 'auth',
    ]);

    Route::get('/admin', [
        'uses' => 'PostController@getAdminDashboard',
        'as' => 'admin',
        'middleware' => 'auth',
    ]);

    Route::get('/account', [
        'uses' => 'UserController@getAccount',
        'as' => 'account',
    ]);

    Route::post('/updateaccount', [
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save',
    ]);

    Route::post('/update-useraccount', [
        'uses' => 'UserController@postSaveUserAccount',
        'as' => 'user-account.save',
    ]);

    Route::get('/userimage/{filename}', [
        'uses' => 'UserController@getUserImage',
        'as' => 'account.image',
    ]);

    Route::post('/createpost', [
        'uses' => 'PostController@postCreatePost',
        'as' => 'post.create',
        'middleware' => 'auth',
    ]);

    Route::get('/post-delete/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete',
        'middleware' => 'auth',
    ]);
    
    Route::get('/comment-delete/{comment_id}', [
       'uses' => 'PostController@getDeleteComment',
        'as' => 'comment.delete',
        'middleware' => 'auth',
    ]);

    Route::get('/user-add', function () {
       return view('admin.user-add');
    })->name('user-add');

    Route::get('/report-delete/{report_id}', [
        'uses' => 'ReportController@getDeleteReport',
        'as' => 'report.delete',
        'middleware' => 'auth',
    ]);

    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',
        'as' => 'signup',
    ]);

    Route::get('/user-delete/{user_id}', [
        'uses' => 'UserController@getDeleteUser',
        'as' => 'user.delete',
        'middleware' => 'auth',
    ]);

    Route::post('/edit', [
        'uses' => 'PostController@postEditPost',
        'as' => 'edit',
    ]);

    Route::get('/report', [
       'uses' => 'ReportController@getReport',
       'as' => 'report',
    ]);

    Route::get('/message', [
       'uses' => 'MessageController@getMessage',
       'as' => 'message',
    ]);

    Route::get('/new-message', [
       'uses' => 'MessageController@getNewMessage',
        'as' => 'new-message',
    ]);

    Route::get('/users', [
        'uses' => 'UserController@getUser',
        'as' => 'users',
    ]);

    Route::get('/like/{imageId}', [
        'uses' => 'PostController@toggleLike',
        'as' => 'like',
    ]);

    Route::post('/comment', [
        'uses' => 'PostController@postCommentPost',
        'as' => 'comment.create',
    ]);

    Route::post('/message-send', [
       'uses' => 'MessageController@postMessage',
        'as' => 'message.send'
    ]);

    Route::post('/report', [
        'uses' => 'PostController@report',
        'as' => 'report.create'
    ]);

    Route::get('/find-user', [
       'uses' => 'UserController@getFind',
        'as' => 'find-user',
        'midddleware' => 'auth',
    ]);

    Route::get('profile/{username}', [
        'uses' => 'ProfileController@index',
        'as' => 'profile',
        'middleware' => 'auth',
    ]);

    Route::get('account/{id}/{username}', [
       'uses' => 'UserController@getUserEdit',
        'as' => 'user-edit',
        'middleware' => 'auth',
    ]);

    Route::get('follow/{id}', 'ProfileController@follow');
});

