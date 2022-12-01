<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
*/

// dd(basename(Request::path()));
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return redirect(route('tenant.dashboard'));
    });

    Route::get('/dashboard', function () {
        dd('Route::tenant.dashboard');

        return view('tenant.dashboard');
    })->name('tenant.dashboard');
});