<?php

namespace App\Http\Controllers;

use App\Services\NowPaymentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $nowPaymentsService;

    public function __construct(NowPaymentsService $nowPaymentsService)
    {
        $this->nowPaymentsService = $nowPaymentsService;
        $this->middleware('auth');
    }

    /**
     * Show payment options page
     *
     * @return \Illuminate\View\View
     */
    public function showPaymentOptions()
    {
        // Get available cryptocurrencies
        $currencies = $this->nowPaymentsService->getCurrencies();
        
        return view('user.finance.payment_options', [
            'currencies' => $currencies['currencies'] ?? []
        ]);
    }

    /**
     * Process payment request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string',
            'payment_for' => 'required|string',
        ]);

        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $paymentFor = $request->input('payment_for');
        
        // Generate unique order ID
        $orderId = 'ORDER-' . Str::uuid();
        
        // Create description based on what the payment is for
        $description = "Payment for {$paymentFor} - User ID: " . auth()->id();
        
        // Set IPN callback URL (must be configured in production)
        $ipnCallbackUrl = route('payment.ipn');
        
        // Create payment in NOWPayments
        $payment = $this->nowPaymentsService->createPayment(
            $amount,
            $currency,
            $orderId,
            $description,
            $ipnCallbackUrl
        );
        
        if (!$payment) {
            return redirect()->back()->with('error', 'Failed to create payment. Please try again later.');
        }
        
        // Store payment details in database
        // This would typically save to your transactions table
        // $transaction = Transaction::create([...]);
        
        // Redirect to payment page
        return view('user.finance.payment_process', [
            'payment' => $payment,
            'orderId' => $orderId,
            'amount' => $amount,
            'currency' => $currency,
            'paymentFor' => $paymentFor
        ]);
    }
    
    /**
     * Check payment status
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkPaymentStatus(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
        ]);
        
        $paymentId = $request->input('payment_id');
        $status = $this->nowPaymentsService->getPaymentStatus($paymentId);
        
        if (!$status) {
            return response()->json(['error' => 'Failed to check payment status'], 500);
        }
        
        return response()->json($status);
    }
    
    /**
     * Handle IPN (Instant Payment Notification) from NOWPayments
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function handleIpn(Request $request)
    {
        // Get the request content
        $requestData = $request->getContent();
        
        // Get the NOWPayments signature from the header
        $signature = $request->header('x-nowpayments-sig');
        
        // Get your IPN secret from environment variables
        $ipnSecret = env('NOWPAYMENTS_IPN_SECRET', '');
        
        // Verify the signature
        if (!$this->nowPaymentsService->verifyIpnSignature($ipnSecret, $requestData, $signature)) {
            Log::error('NOWPayments IPN: Invalid signature');
            return response('Invalid signature', 400);
        }
        
        // Parse the request data
        $data = json_decode($requestData, true);
        
        // Process the payment notification
        // This would typically update your transaction status in the database
        // and trigger any necessary actions (e.g., activating a subscription)
        
        Log::info('NOWPayments IPN received', $data);
        
        // Example: Update transaction status
        // $transaction = Transaction::where('payment_id', $data['payment_id'])->first();
        // if ($transaction) {
        //     $transaction->status = $data['payment_status'];
        //     $transaction->save();
        // }
        
        return response('OK', 200);
    }
    
    /**
     * Show payment success page
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showPaymentSuccess(Request $request)
    {
        return view('user.finance.payment_success', [
            'orderId' => $request->input('order_id')
        ]);
    }
    
    /**
     * Show payment history
     *
     * @return \Illuminate\View\View
     */
    public function showPaymentHistory()
    {
        // Get payment history from NOWPayments
        // This would typically be combined with your local transaction records
        $payments = $this->nowPaymentsService->getPayments();
        
        return view('user.finance.payment_history', [
            'payments' => $payments['data'] ?? []
        ]);
    }
}
