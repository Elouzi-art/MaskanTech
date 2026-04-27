<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home_hero');
});

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('register');
})->name('register');


// Admin routes (dashboard)
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
});



