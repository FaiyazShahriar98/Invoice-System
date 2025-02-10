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

// ✅ Export route should be BEFORE resource routes
Route::get('/invoices/export', [InvoiceController::class, 'export'])->name('invoices.export')->middleware('auth');

// ✅ Invoice CRUD Routes (Protected by Authentication) (excluding 'show')
Route::resource('invoices', InvoiceController::class)
    ->except(['show']) // Exclude show method to prevent conflicts
    ->middleware('auth');

// ✅ Toggle status route
Route::patch('/invoices/{id}/toggle-status', [InvoiceController::class, 'toggleStatus'])->name('invoices.toggleStatus')->middleware('auth');
