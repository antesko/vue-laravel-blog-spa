<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/token', 'AuthController@token');
Route::post('auth/register', 'AuthController@register');

// TODO: add all these routes to auth middleware
Route::resource('posts', 'PostController');
Route::get('posts/{id}/comments', 'PostController@comments');

Route::resource('comments', 'CommentController');

Route::resource('users', 'UserController');
Route::get('users/{id}/posts', 'UserController@posts');

Route::post('upload/image', 'FileController@uploadImage');