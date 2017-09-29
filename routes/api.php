<?php

use Illuminate\Http\Request;

Route::post('auth/token', 'AuthController@token');
Route::post('auth/register', 'AuthController@register');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('posts', 'PostController');
    Route::get('posts/{id}/comments', 'PostController@comments');

    Route::resource('comments', 'CommentController');

    Route::resource('users', 'UserController');
    Route::get('users/{id}/posts', 'UserController@posts');

    Route::post('upload/image', 'FileController@uploadImage');
});