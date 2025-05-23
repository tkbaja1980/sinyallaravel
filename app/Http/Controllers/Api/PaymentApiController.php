<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentApiController extends Controller
{
    protected $nowPaymentsService;

    public function __construct(NowPaymentsService $nowPaymentsService)
    {
        $this->nowPaymentsService = $nowPaymentsService;
    }

    /**
     * Get estimated price for cryptocurrency payment
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEstimatedPrice(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string',
        ]);

        $amount = $request->input('amount');
        $currency = $request->input('currency');
        
        // Get estimated price from NOWPayments
        $estimate = $this->nowPaymentsService->getEstimatedPrice($amount, 'usd', $currency);
        
        if (!$estimate) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get estimated price',
                'estimated_amount' => null
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'estimated_amount' => $estimate['estimated_amount'] ?? null,
            'currency' => $currency
        ]);
    }

    /**
     * Get available cryptocurrencies
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrencies()
    {
        $currencies = $this->nowPaymentsService->getCurrencies();
        
        if (!$currencies) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get currencies',
                'currencies' => []
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'currencies' => $currencies['currencies'] ?? []
        ]);
    }

    /**
     * Get minimum payment amount
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMinAmount(Request $request)
    {
        $request->validate([
            'currency_from' => 'required|string',
            'currency_to' => 'required|string',
        ]);

        $currencyFrom = $request->input('currency_from');
        $currencyTo = $request->input('currency_to');
        
        $minAmount = $this->nowPaymentsService->getMinAmount($currencyFrom, $currencyTo);
        
        if (!$minAmount) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get minimum amount',
                'min_amount' => null
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'min_amount' => $minAmount['min_amount'] ?? null,
            'currency_from' => $currencyFrom,
            'currency_to' => $currencyTo
        ]);
    }
}
