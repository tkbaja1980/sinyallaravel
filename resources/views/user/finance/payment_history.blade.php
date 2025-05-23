@extends('layouts.dashboard')

@section('title', 'Riwayat Pembayaran')

@section('dashboard-content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Riwayat Pembayaran Cryptocurrency</h5>
        <a href="{{ route('payment.options') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Pembayaran Baru
        </a>
    </div>
    <div class="card-body">
        @if(count($payments) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Pembayaran</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Cryptocurrency</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment['payment_id'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment['created_at'])->format('d M Y H:i') }}</td>
                            <td>${{ $payment['price_amount'] }} {{ $payment['price_currency'] }}</td>
                            <td>{{ $payment['pay_amount'] }} {{ strtoupper($payment['pay_currency']) }}</td>
                            <td>
                                @php
                                    $statusClass = 'bg-secondary';
                                    $statusText = 'Unknown';
                                    
                                    switch($payment['payment_status']) {
                                        case 'waiting':
                                            $statusClass = 'bg-warning';
                                            $statusText = 'Menunggu';
                                            break;
                                        case 'confirming':
                                            $statusClass = 'bg-info';
                                            $statusText = 'Mengkonfirmasi';
                                            break;
                                        case 'confirmed':
                                            $statusClass = 'bg-primary';
                                            $statusText = 'Terkonfirmasi';
                                            break;
                                        case 'sending':
                                            $statusClass = 'bg-info';
                                            $statusText = 'Memproses';
                                            break;
                                        case 'partially_paid':
                                            $statusClass = 'bg-warning';
                                            $statusText = 'Dibayar Sebagian';
                                            break;
                                        case 'finished':
                                            $statusClass = 'bg-success';
                                            $statusText = 'Selesai';
                                            break;
                                        case 'failed':
                                            $statusClass = 'bg-danger';
                                            $statusText = 'Gagal';
                                            break;
                                        case 'expired':
                                            $statusClass = 'bg-secondary';
                                            $statusText = 'Kedaluwarsa';
                                            break;
                                    }
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewPaymentDetails('{{ $payment['payment_id'] }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                <h5>Tidak ada riwayat pembayaran</h5>
                <p class="text-muted">Anda belum melakukan pembayaran cryptocurrency apapun.</p>
                <a href="{{ route('payment.options') }}" class="btn btn-primary">Buat Pembayaran</a>
            </div>
        @endif
    </div>
</div>

<!-- Payment Details Modal -->
<div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentDetailsModalLabel">Detail Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center" id="paymentDetailsLoader">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat detail pembayaran...</p>
                </div>
                
                <div id="paymentDetailsContent" class="d-none">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informasi Pembayaran</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>ID Pembayaran:</span>
                                    <span class="fw-bold" id="modal-payment-id"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>ID Pesanan:</span>
                                    <span class="fw-bold" id="modal-order-id"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Tanggal:</span>
                                    <span id="modal-created-at"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Deskripsi:</span>
                                    <span id="modal-description"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Status:</span>
                                    <span id="modal-status"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Detail Transaksi</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Jumlah:</span>
                                    <span class="fw-bold" id="modal-price-amount"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Cryptocurrency:</span>
                                    <span id="modal-pay-currency"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Jumlah Crypto:</span>
                                    <span id="modal-pay-amount"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Alamat Pembayaran:</span>
                                    <span class="text-break" id="modal-pay-address"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="modal-transaction-details" class="d-none">
                        <h6>Detail Transaksi Blockchain</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Hash Transaksi</th>
                                        <th>Jumlah</th>
                                        <th>Konfirmasi</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-transactions-body">
                                    <!-- Transaction details will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div id="paymentDetailsError" class="d-none">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <span id="paymentDetailsErrorMessage">Terjadi kesalahan saat memuat detail pembayaran.</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function viewPaymentDetails(paymentId) {
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('paymentDetailsModal'));
        modal.show();
        
        // Show loader, hide content and error
        document.getElementById('paymentDetailsLoader').classList.remove('d-none');
        document.getElementById('paymentDetailsContent').classList.add('d-none');
        document.getElementById('paymentDetailsError').classList.add('d-none');
        
        // In a real implementation, this would fetch payment details from your backend
        // For demo purposes, we'll simulate a response
        setTimeout(() => {
            // Hide loader
            document.getElementById('paymentDetailsLoader').classList.add('d-none');
            
            // Simulate API call
            if (Math.random() > 0.1) { // 90% success rate for demo
                // Show content
                document.getElementById('paymentDetailsContent').classList.remove('d-none');
                
                // Populate modal with dummy data
                document.getElementById('modal-payment-id').textContent = paymentId;
                document.getElementById('modal-order-id').textContent = 'ORDER-' + Math.random().toString(36).substring(2, 10).toUpperCase();
                document.getElementById('modal-created-at').textContent = new Date().toLocaleString();
                document.getElementById('modal-description').textContent = 'Payment for deposit';
                document.getElementById('modal-status').innerHTML = '<span class="badge bg-success">Finished</span>';
                document.getElementById('modal-price-amount').textContent = '$50.00 USD';
                document.getElementById('modal-pay-currency').textContent = 'BTC';
                document.getElementById('modal-pay-amount').textContent = '0.001234 BTC';
                document.getElementById('modal-pay-address').textContent = '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';
                
                // Show transaction details for some payments
                if (Math.random() > 0.5) {
                    document.getElementById('modal-transaction-details').classList.remove('d-none');
                    document.getElementById('modal-transactions-body').innerHTML = `
                        <tr>
                            <td class="text-break">3a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u</td>
                            <td>0.001234 BTC</td>
                            <td>6</td>
                        </tr>
                    `;
                } else {
                    document.getElementById('modal-transaction-details').classList.add('d-none');
                }
            } else {
                // Show error
                document.getElementById('paymentDetailsError').classList.remove('d-none');
                document.getElementById('paymentDetailsErrorMessage').textContent = 'Terjadi kesalahan saat memuat detail pembayaran. Silakan coba lagi nanti.';
            }
        }, 1000);
    }
</script>
@endsection
