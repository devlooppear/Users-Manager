<?php

use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::get('/', function () {
        return view('pages.home'); 
    })->name('home');
});

Route::get('/login', function () {
    return view('pages.login'); 
})->name('login');
