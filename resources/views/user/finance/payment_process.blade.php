@extends('layouts.dashboard')

@section('title', 'Proses Pembayaran')

@section('dashboard-content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Pembayaran Cryptocurrency</h5>
    </div>
    <div class="card-body">
        <div class="text-center mb-4">
            <div class="spinner-border text-primary mb-3" role="status" id="loadingSpinner">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h4 id="statusText">Mempersiapkan Pembayaran...</h4>
            <p class="text-muted" id="statusDescription">Mohon tunggu sementara kami mempersiapkan detail pembayaran Anda.</p>
        </div>

        <div id="paymentDetails" class="d-none">
            <div class="alert alert-warning">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading">Pembayaran Menunggu</h5>
                        <p class="mb-0">Silakan transfer cryptocurrency sesuai jumlah yang ditentukan ke alamat di bawah ini. Pembayaran akan diproses secara otomatis setelah konfirmasi jaringan.</p>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card h-100 border">
                        <div class="card-body">
                            <h5 class="card-title">Detail Pesanan</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>ID Pesanan:</span>
                                    <span class="fw-bold">{{ $orderId ?? 'ORDER-123456' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Jumlah:</span>
                                    <span class="fw-bold">${{ $amount ?? '50.00' }} USD</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Pembayaran Untuk:</span>
                                    <span class="fw-bold">{{ $paymentFor ?? 'Deposit' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Status:</span>
                                    <span class="badge bg-warning" id="paymentStatus">Menunggu Pembayaran</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border">
                        <div class="card-body">
                            <h5 class="card-title">Detail Pembayaran</h5>
                            <div class="text-center mb-3">
                                <div id="qrCodeContainer" class="mb-2">
                                    <!-- QR code will be inserted here -->
                                </div>
                                <button class="btn btn-sm btn-outline-secondary" onclick="copyPaymentAddress()">
                                    <i class="fas fa-copy me-1"></i> Salin Alamat
                                </button>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="fw-bold mb-1">Alamat {{ strtoupper($currency ?? 'BTC') }}:</div>
                                    <div class="text-break" id="cryptoAddress">{{ $payment['pay_address'] ?? '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa' }}</div>
                                </li>
                                <li class="list-group-item">
                                    <div class="fw-bold mb-1">Jumlah {{ strtoupper($currency ?? 'BTC') }}:</div>
                                    <div class="text-break" id="cryptoAmount">{{ $payment['pay_amount'] ?? '0.001234' }}</div>
                                </li>
                                <li class="list-group-item">
                                    <div class="small text-danger">
                                        <i class="fas fa-exclamation-triangle me-1"></i> Pastikan Anda mengirim tepat jumlah yang ditentukan ke alamat yang benar.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <h6><i class="fas fa-info-circle me-2"></i> Informasi Penting:</h6>
                <ul class="mb-0">
                    <li>Pembayaran biasanya membutuhkan 1-3 konfirmasi jaringan.</li>
                    <li>Jangan tutup halaman ini sampai pembayaran selesai.</li>
                    <li>Setelah pembayaran dikonfirmasi, Anda akan diarahkan ke halaman sukses.</li>
                    <li>Jika Anda mengalami masalah, silakan hubungi dukungan pelanggan kami.</li>
                </ul>
            </div>
        </div>

        <div id="paymentSuccess" class="d-none">
            <div class="text-center">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h3>Pembayaran Berhasil!</h3>
                <p class="lead">Terima kasih atas pembayaran Anda. Transaksi telah berhasil diproses.</p>
                <div class="mt-4">
                    <a href="{{ route('user.finance.index') }}" class="btn btn-primary">Kembali ke Keuangan</a>
                </div>
            </div>
        </div>

        <div id="paymentError" class="d-none">
            <div class="text-center">
                <div class="mb-4">
                    <i class="fas fa-times-circle text-danger fa-5x"></i>
                </div>
                <h3>Pembayaran Gagal</h3>
                <p class="lead" id="errorMessage">Terjadi kesalahan saat memproses pembayaran Anda.</p>
                <div class="mt-4">
                    <a href="{{ route('payment.options') }}" class="btn btn-primary">Coba Lagi</a>
                    <a href="{{ route('user.finance.index') }}" class="btn btn-outline-secondary ms-2">Kembali ke Keuangan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcode.js@1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentId = "{{ $payment['payment_id'] ?? '' }}";
        const paymentDetails = document.getElementById('paymentDetails');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const statusText = document.getElementById('statusText');
        const statusDescription = document.getElementById('statusDescription');
        const paymentSuccess = document.getElementById('paymentSuccess');
        const paymentError = document.getElementById('paymentError');
        const paymentStatus = document.getElementById('paymentStatus');
        const errorMessage = document.getElementById('errorMessage');
        const qrCodeContainer = document.getElementById('qrCodeContainer');
        const cryptoAddress = document.getElementById('cryptoAddress');
        
        // Show payment details after a short delay (simulating loading)
        setTimeout(() => {
            loadingSpinner.classList.add('d-none');
            paymentDetails.classList.remove('d-none');
            
            // Generate QR code for the crypto address
            if (qrCodeContainer && cryptoAddress) {
                const addressValue = cryptoAddress.textContent.trim();
                if (addressValue) {
                    QRCode.toCanvas(qrCodeContainer, addressValue, function (error) {
                        if (error) console.error(error);
                    });
                }
            }
            
            // Start checking payment status if we have a payment ID
            if (paymentId) {
                checkPaymentStatus();
            }
        }, 1500);
        
        // Function to check payment status
        function checkPaymentStatus() {
            if (!paymentId) return;
            
            fetch("{{ route('payment.check-status') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    payment_id: paymentId
                })
            })
            .then(response => response.json())
            .then(data => {
                updatePaymentStatus(data.payment_status || 'waiting');
                
                // If payment is not in a final state, check again after a delay
                if (['waiting', 'confirming', 'confirmed'].includes(data.payment_status)) {
                    setTimeout(checkPaymentStatus, 10000); // Check every 10 seconds
                }
            })
            .catch(error => {
                console.error('Error checking payment status:', error);
                // Continue checking despite errors
                setTimeout(checkPaymentStatus, 15000);
            });
        }
        
        // Function to update UI based on payment status
        function updatePaymentStatus(status) {
            switch(status) {
                case 'waiting':
                    paymentStatus.textContent = 'Menunggu Pembayaran';
                    paymentStatus.className = 'badge bg-warning';
                    break;
                case 'confirming':
                    paymentStatus.textContent = 'Mengkonfirmasi';
                    paymentStatus.className = 'badge bg-info';
                    statusText.textContent = 'Pembayaran Sedang Dikonfirmasi';
                    statusDescription.textContent = 'Kami telah menerima pembayaran Anda dan sedang menunggu konfirmasi jaringan.';
                    break;
                case 'confirmed':
                    paymentStatus.textContent = 'Terkonfirmasi';
                    paymentStatus.className = 'badge bg-primary';
                    break;
                case 'sending':
                    paymentStatus.textContent = 'Memproses';
                    paymentStatus.className = 'badge bg-info';
                    break;
                case 'partially_paid':
                    paymentStatus.textContent = 'Dibayar Sebagian';
                    paymentStatus.className = 'badge bg-warning';
                    break;
                case 'finished':
                    paymentStatus.textContent = 'Selesai';
                    paymentStatus.className = 'badge bg-success';
                    paymentDetails.classList.add('d-none');
                    paymentSuccess.classList.remove('d-none');
                    break;
                case 'failed':
                    paymentStatus.textContent = 'Gagal';
                    paymentStatus.className = 'badge bg-danger';
                    paymentDetails.classList.add('d-none');
                    paymentError.classList.remove('d-none');
                    errorMessage.textContent = 'Pembayaran gagal diproses. Silakan coba lagi atau hubungi dukungan pelanggan.';
                    break;
                case 'expired':
                    paymentStatus.textContent = 'Kedaluwarsa';
                    paymentStatus.className = 'badge bg-secondary';
                    paymentDetails.classList.add('d-none');
                    paymentError.classList.remove('d-none');
                    errorMessage.textContent = 'Waktu pembayaran telah habis. Silakan buat pembayaran baru.';
                    break;
                default:
                    paymentStatus.textContent = status;
                    paymentStatus.className = 'badge bg-secondary';
            }
        }
        
        // Function to copy crypto address to clipboard
        window.copyPaymentAddress = function() {
            const addressText = cryptoAddress.textContent.trim();
            navigator.clipboard.writeText(addressText).then(() => {
                alert('Alamat disalin ke clipboard!');
            }).catch(err => {
                console.error('Gagal menyalin alamat:', err);
            });
        };
    });
</script>
@endsection
