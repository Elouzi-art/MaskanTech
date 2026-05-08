<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/biens', function () {
    return view('pages.properties');
});
Route::get('/biens/{id}', function ($id) {
    return view('pages.property-detail');
});