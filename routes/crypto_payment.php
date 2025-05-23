<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptoPaymentController;

// Crypto payment routes
Route::middleware(['auth'])->group(function () {
    Route::post('/crypto/payment/process', [CryptoPaymentController::class, 'processPayment'])->name('crypto.payment.process');
    Route::get('/crypto/payment/status', [CryptoPaymentController::class, 'checkStatus'])->name('crypto.payment.status');
});

// IPN route (no auth middleware as it's called by NOWPayments)
Route::post('/crypto/payment/ipn', [CryptoPaymentController::class, 'handleIpn'])->name('crypto.payment.ipn');
