@extends('layouts.dashboard')

@section('title', 'Opsi Pembayaran')

@section('dashboard-content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Pilih Metode Pembayaran Cryptocurrency</h5>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i> Anda dapat melakukan deposit menggunakan berbagai cryptocurrency melalui NOWPayments.
        </div>

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah (USD)</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" id="amount" name="amount" min="10" step="1" value="50" required>
                </div>
                <div class="form-text">Minimum deposit adalah $10</div>
            </div>

            <div class="mb-3">
                <label for="currency" class="form-label">Cryptocurrency</label>
                <select class="form-select" id="currency" name="currency" required>
                    @if(isset($currencies) && count($currencies) > 0)
                        @foreach($currencies as $currency)
                            <option value="{{ $currency }}">{{ strtoupper($currency) }}</option>
                        @endforeach
                    @else
                        <option value="btc">Bitcoin (BTC)</option>
                        <option value="eth">Ethereum (ETH)</option>
                        <option value="ltc">Litecoin (LTC)</option>
                        <option value="usdt">Tether (USDT)</option>
                        <option value="usdc">USD Coin (USDC)</option>
                        <option value="bnb">Binance Coin (BNB)</option>
                        <option value="xrp">Ripple (XRP)</option>
                        <option value="doge">Dogecoin (DOGE)</option>
                    @endif
                </select>
            </div>

            <div class="mb-3">
                <label for="payment_for" class="form-label">Tujuan Pembayaran</label>
                <select class="form-select" id="payment_for" name="payment_for" required>
                    <option value="deposit">Deposit Saldo</option>
                    <option value="signal_subscription">Langganan Sinyal Trading</option>
                    <option value="bot_license">Lisensi Bot Trading</option>
                </select>
            </div>

            <div id="estimatedAmount" class="alert alert-secondary d-none">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold">Estimasi Pembayaran:</span>
                        <span id="cryptoAmount">0</span> <span id="cryptoCurrency">BTC</span>
                    </div>
                    <div class="spinner-border spinner-border-sm text-primary d-none" id="estimateLoader" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="small text-muted mt-1">
                    Nilai estimasi dapat berubah saat checkout berdasarkan harga pasar terkini
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Lanjutkan ke Pembayaran</button>
            </div>
        </form>

        <hr>

        <div class="mt-4">
            <h6>Informasi Pembayaran:</h6>
            <ul class="list-unstyled">
                <li><i class="fas fa-check-circle text-success me-2"></i> Pembayaran diproses secara instan</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Transaksi aman dan terenkripsi</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Dukungan untuk berbagai cryptocurrency</li>
                <li><i class="fas fa-check-circle text-success me-2"></i> Tidak ada biaya tambahan dari platform kami</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('amount');
        const currencySelect = document.getElementById('currency');
        const estimatedAmount = document.getElementById('estimatedAmount');
        const cryptoAmount = document.getElementById('cryptoAmount');
        const cryptoCurrency = document.getElementById('cryptoCurrency');
        const estimateLoader = document.getElementById('estimateLoader');

        function updateEstimate() {
            const amount = amountInput.value;
            const currency = currencySelect.value;
            
            if (amount < 10) return;
            
            estimatedAmount.classList.remove('d-none');
            estimateLoader.classList.remove('d-none');
            
            // In a real implementation, this would call your backend to get an estimate
            // from NOWPayments API
            fetch(`/api/payment/estimate?amount=${amount}&currency=${currency}`)
                .then(response => response.json())
                .then(data => {
                    cryptoAmount.textContent = data.estimated_amount || '0.0123';
                    cryptoCurrency.textContent = currency.toUpperCase();
                    estimateLoader.classList.add('d-none');
                })
                .catch(error => {
                    console.error('Error fetching estimate:', error);
                    // Fallback to dummy values for demo
                    cryptoAmount.textContent = (amount / getCryptoRate(currency)).toFixed(6);
                    cryptoCurrency.textContent = currency.toUpperCase();
                    estimateLoader.classList.add('d-none');
                });
        }
        
        // Dummy exchange rates for demo purposes
        function getCryptoRate(currency) {
            const rates = {
                'btc': 50000,
                'eth': 3000,
                'ltc': 200,
                'usdt': 1,
                'usdc': 1,
                'bnb': 400,
                'xrp': 1.2,
                'doge': 0.25
            };
            return rates[currency] || 1;
        }

        amountInput.addEventListener('change', updateEstimate);
        amountInput.addEventListener('keyup', updateEstimate);
        currencySelect.addEventListener('change', updateEstimate);
        
        // Initial estimate
        updateEstimate();
    });
</script>
@endsection
