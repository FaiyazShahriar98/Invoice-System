<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;

// Redirect '/' to home if authenticated, otherwise show welcome page
Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : view('welcome');
});

// Authentication Routes
Auth::routes();

// Dashboard Route (only for logged-in users)
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Invoice CRUD Routes (Protected by Authentication)
Route::resource('invoices', InvoiceController::class)->middleware('auth');
