<?php

use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Route;

Route::post('/payments', [PaymentController::class, 'process']);
Route::post('/webhook', [PaymentController::class, 'handle'])->name('payment.webhook');