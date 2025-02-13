<?php

use App\Http\Controllers\InvoiceAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ✅ Public Route to Test API (No Authentication Required)
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// ✅ Public Debug Route (No Authentication)
Route::get('/debug', [InvoiceAPIController::class, 'debug']);

// 🔒 Secure API Routes (Require API Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/invoices', [InvoiceAPIController::class, 'index']); // Get all invoices
    Route::get('/invoices/{id}', [InvoiceAPIController::class, 'show']); // Get a single invoice
    Route::post('/invoices', [InvoiceAPIController::class, 'store']); // Create an invoice
    Route::put('/invoices/{id}', [InvoiceAPIController::class, 'update']); // Update an invoice
    Route::delete('/invoices/{id}', [InvoiceAPIController::class, 'destroy']); // Delete an invoice
});
