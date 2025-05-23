<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CryptoPaymentController extends Controller
{
    protected $nowPaymentsService;

    public function __construct(NowPaymentsService $nowPaymentsService)
    {
        $this->nowPaymentsService = $nowPaymentsService;
        $this->middleware('auth')->except(['handleIpn']);
        $this->middleware('verify.nowpayments.ipn')->only(['handleIpn']);
    }

    /**
     * Process a new crypto payment
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'currency' => 'required|string',
            'item_type' => 'required|string|in:deposit,signal,bot,subscription',
            'item_id' => 'nullable|integer',
        ]);

        $user = Auth::user();
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $itemType = $request->input('item_type');
        $itemId = $request->input('item_id');
        
        // Generate unique order ID
        $orderId = 'ORDER-' . Str::uuid();
        
        // Create description based on what the payment is for
        $description = "Payment for {$itemType}" . ($itemId ? " (ID: {$itemId})" : "") . " - User: {$user->email}";
        
        // Set IPN callback URL
        $ipnCallbackUrl = route('payment.ipn');
        
        // Create payment in NOWPayments
        $payment = $this->nowPaymentsService->createPayment(
            $amount,
            'usd',
            $currency,
            $orderId,
            $description,
            $ipnCallbackUrl
        );
        
        if (!$payment || !isset($payment['payment_id'])) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment. Please try again later.'
            ], 500);
        }
        
        // Store transaction in database
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'type' => $itemType,
            'amount' => $amount,
            'description' => $description,
            'status' => 'pending',
            'payment_method' => 'crypto_' . $currency,
            'payment_id' => $payment['payment_id'],
            'transaction_reference' => $orderId,
        ]);
        
        // Return payment details
        return response()->json([
            'success' => true,
            'payment' => $payment,
            'transaction_id' => $transaction->id,
            'redirect_url' => route('payment.process', ['payment_id' => $payment['payment_id']])
        ]);
    }
    
    /**
     * Handle IPN (Instant Payment Notification) from NOWPayments
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function handleIpn(Request $request)
    {
        // Parse the request data
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['payment_id']) || !isset($data['payment_status'])) {
            Log::error('NOWPayments IPN: Invalid data format', $data);
            return response('Invalid data format', 400);
        }
        
        Log::info('NOWPayments IPN received', $data);
        
        // Find the transaction by payment_id
        $transaction = Transaction::where('payment_id', $data['payment_id'])->first();
        
        if (!$transaction) {
            Log::error('NOWPayments IPN: Transaction not found', ['payment_id' => $data['payment_id']]);
            return response('Transaction not found', 404);
        }
        
        // Update transaction status based on payment status
        switch ($data['payment_status']) {
            case 'finished':
                $transaction->status = 'completed';
                break;
            case 'partially_paid':
                $transaction->status = 'partially_paid';
                break;
            case 'confirming':
                $transaction->status = 'confirming';
                break;
            case 'waiting':
                $transaction->status = 'pending';
                break;
            case 'expired':
            case 'failed':
                $transaction->status = 'failed';
                break;
            default:
                $transaction->status = 'pending';
        }
        
        $transaction->save();
        
        // Process the transaction based on its type
        if ($transaction->status === 'completed') {
            $this->processCompletedTransaction($transaction, $data);
        }
        
        return response('OK', 200);
    }
    
    /**
     * Process a completed transaction
     *
     * @param Transaction $transaction
     * @param array $paymentData
     * @return void
     */
    private function processCompletedTransaction(Transaction $transaction, array $paymentData)
    {
        $user = $transaction->user;
        
        switch ($transaction->type) {
            case 'deposit':
                // Add funds to user's balance
                $user->balance += $transaction->amount;
                $user->save();
                break;
                
            case 'signal':
                // Grant access to signal
                // Implementation depends on your signal subscription model
                break;
                
            case 'bot':
                // Generate license key for bot
                // Implementation depends on your bot licensing model
                break;
                
            case 'subscription':
                // Activate subscription
                // Implementation depends on your subscription model
                break;
        }
        
        // Create notification for user
        // $user->notify(new PaymentCompleted($transaction));
    }
    
    /**
     * Check payment status
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
        ]);
        
        $paymentId = $request->input('payment_id');
        
        // Find transaction in database
        $transaction = Transaction::where('payment_id', $paymentId)
            ->where('user_id', Auth::id())
            ->first();
            
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }
        
        // Get payment status from NOWPayments
        $paymentStatus = $this->nowPaymentsService->getPaymentStatus($paymentId);
        
        if (!$paymentStatus) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check payment status',
                'transaction' => $transaction
            ], 500);
        }
        
        // Update transaction status if needed
        if ($transaction->status !== 'completed' && $paymentStatus['payment_status'] === 'finished') {
            $transaction->status = 'completed';
            $transaction->save();
            
            // Process the completed transaction
            $this->processCompletedTransaction($transaction, $paymentStatus);
        }
        
        return response()->json([
            'success' => true,
            'transaction' => $transaction,
            'payment_status' => $paymentStatus
        ]);
    }
}
