<?php

Route::get('{path}', function () {
    return view('index');
})->where( 'path', '(.*)?' );