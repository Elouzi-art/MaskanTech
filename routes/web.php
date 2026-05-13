<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/biens', function () {
    return view('pages.properties');
});

Route::get('/biens/{id}', function ($id) {
    return view('pages.property-detail');
})->name('property.show');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::get('/etudiants', function () {
    return view('pages.students');
})->name('students');

Route::get('/proprietaires', function () {
    return view('pages.owners');
})->name('owners');