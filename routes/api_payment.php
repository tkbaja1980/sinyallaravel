<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentApiController;

// API routes for payment
Route::prefix('api/payment')->group(function () {
    Route::get('/estimate', [PaymentApiController::class, 'getEstimatedPrice']);
    Route::get('/currencies', [PaymentApiController::class, 'getCurrencies']);
    Route::get('/min-amount', [PaymentApiController::class, 'getMinAmount']);
});
