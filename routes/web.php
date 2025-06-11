<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('api-home');
});

Route::get('/docs', function () {
    return view('api-docs');
});
