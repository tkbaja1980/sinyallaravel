<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyNowPaymentsIpn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the NOWPayments signature from the header
        $signature = $request->header('x-nowpayments-sig');
        
        // If no signature is present, reject the request
        if (!$signature) {
            return response('Unauthorized', 401);
        }
        
        // Get the IPN secret from environment variables
        $ipnSecret = env('NOWPAYMENTS_IPN_SECRET', '');
        
        // If no IPN secret is configured, reject the request
        if (empty($ipnSecret)) {
            return response('Configuration error', 500);
        }
        
        // Get the request content
        $requestData = $request->getContent();
        
        // Verify the signature
        $hmac = hash_hmac('sha512', $requestData, $ipnSecret);
        if (!hash_equals($hmac, $signature)) {
            return response('Invalid signature', 400);
        }
        
        return $next($request);
    }
}
