<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

// Payment routes
Route::middleware(['auth'])->group(function () {
    Route::get('/payment/options', [PaymentController::class, 'showPaymentOptions'])->name('payment.options');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/check-status', [PaymentController::class, 'checkPaymentStatus'])->name('payment.check-status');
    Route::get('/payment/success', [PaymentController::class, 'showPaymentSuccess'])->name('payment.success');
    Route::get('/payment/history', [PaymentController::class, 'showPaymentHistory'])->name('payment.history');
});

// IPN route (no auth middleware as it's called by NOWPayments)
Route::post('/payment/ipn', [PaymentController::class, 'handleIpn'])->name('payment.ipn');
