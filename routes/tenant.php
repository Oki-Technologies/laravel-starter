<?php

use Illuminate\Support\Facades\Route;

// Route::get('/login', function () {
//     dd('login');
// })->name('login');

// dd(__FILE__);

Route::middleware([
    // 'auth:sanctum',
    // config('jetstream.auth_session'),
    // 'verified'
])->name('tenant.')->group(function () {
    Route::get('/', function () {
        return view('tenant.welcome');
    })->name('home');

    Route::get('/dashboard', function () {
        return view('tenant.dashboard');
    })->name('dashboard');
});
