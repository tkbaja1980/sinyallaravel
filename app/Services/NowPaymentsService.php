<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class NowPaymentsService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl = 'https://api.nowpayments.io/v1/';

    public function __construct()
    {
        $this->apiKey = env('NOWPAYMENTS_API_KEY', '63X4QZX-VPT42HV-KWPYCYZ-G5P4S1N');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Get available currencies
     *
     * @return array|null
     */
    public function getCurrencies()
    {
        try {
            $response = $this->client->get('currencies');
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('NOWPayments API Error (getCurrencies): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get minimum payment amount
     *
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return array|null
     */
    public function getMinAmount($currencyFrom, $currencyTo)
    {
        try {
            $response = $this->client->get("min-amount?currency_from={$currencyFrom}&currency_to={$currencyTo}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('NOWPayments API Error (getMinAmount): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get estimated price
     *
     * @param float $amount
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return array|null
     */
    public function getEstimatedPrice($amount, $currencyFrom, $currencyTo)
    {
        try {
            $response = $this->client->get("estimate?amount={$amount}&currency_from={$currencyFrom}&currency_to={$currencyTo}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('NOWPayments API Error (getEstimatedPrice): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create a payment
     *
     * @param float $price
     * @param string $currency
     * @param string $orderId
     * @param string $orderDescription
     * @param string $ipnCallbackUrl
     * @return array|null
     */
    public function createPayment($price, $currency, $orderId, $orderDescription, $ipnCallbackUrl = null)
    {
        try {
            $payload = [
                'price_amount' => $price,
                'price_currency' => $currency,
                'order_id' => $orderId,
                'order_description' => $orderDescription,
            ];

            if ($ipnCallbackUrl) {
                $payload['ipn_callback_url'] = $ipnCallbackUrl;
            }

            $response = $this->client->post('payment', [
                'json' => $payload
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('NOWPayments API Error (createPayment): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get payment status
     *
     * @param string $paymentId
     * @return array|null
     */
    public function getPaymentStatus($paymentId)
    {
        try {
            $response = $this->client->get("payment/{$paymentId}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('NOWPayments API Error (getPaymentStatus): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get payment list
     *
     * @param int $limit
     * @param int $page
     * @param string $sortBy
     * @param string $orderBy
     * @param string $dateFrom
     * @param string $dateTo
     * @return array|null
     */
    public function getPayments($limit = 10, $page = 0, $sortBy = 'created_at', $orderBy = 'desc', $dateFrom = null, $dateTo = null)
    {
        try {
            $query = http_build_query([
                'limit' => $limit,
                'page' => $page,
                'sortBy' => $sortBy,
                'orderBy' => $orderBy,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
            ]);

            $response = $this->client->get("payment?{$query}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error('NOWPayments API Error (getPayments): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Verify IPN signature
     *
     * @param string $ipnSecret
     * @param string $requestData
     * @param string $signature
     * @return bool
     */
    public function verifyIpnSignature($ipnSecret, $requestData, $signature)
    {
        $hmac = hash_hmac('sha512', $requestData, $ipnSecret);
        return hash_equals($hmac, $signature);
    }
}
