<?php

use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/users', function () {
    return view('pages.users.users');
})->name('users');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');
