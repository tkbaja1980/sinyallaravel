@extends('layouts.dashboard')

@section('title', 'Keuangan Saya')

@section('actions')
<a href="{{ route('user.finance.withdraw') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-money-bill-wave"></i> Tarik Dana
</a>
@endsection

@section('dashboard-content')
<!-- Finance Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card dashboard-card bg-primary text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="title">Saldo Tersedia</div>
                <div class="value">{{ $stats->available_balance ?? 0 }} USD</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-success text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="title">Total Pendapatan</div>
                <div class="value">{{ $stats->total_earnings ?? 0 }} USD</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-info text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="title">Total Pembelian</div>
                <div class="value">{{ $stats->total_purchases ?? 0 }} USD</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-warning text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="title">Total Penarikan</div>
                <div class="value">{{ $stats->total_withdrawals ?? 0 }} USD</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Deposit Dana</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Tambahkan dana ke akun Anda untuk membeli produk atau layanan.</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="depositAmount" placeholder="0" min="10">
                            <label for="depositAmount">Jumlah (USD)</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="paymentMethod">
                                <option value="credit_card">Kartu Kredit/Debit</option>
                                <option value="paypal">PayPal</option>
                                <option value="crypto">Cryptocurrency</option>
                                <option value="bank_transfer">Transfer Bank</option>
                            </select>
                            <label for="paymentMethod">Metode Pembayaran</label>
                        </div>
                    </div>
                </div>
                <div class="d-grid mt-3">
                    <button class="btn btn-primary" type="button">Deposit Sekarang</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Tarik Dana</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Tarik dana dari saldo tersedia Anda ke rekening bank atau dompet kripto.</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="withdrawAmount" placeholder="0" min="10" max="{{ $stats->available_balance ?? 0 }}">
                            <label for="withdrawAmount">Jumlah (USD)</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="withdrawMethod">
                                <option value="bank_transfer">Transfer Bank</option>
                                <option value="paypal">PayPal</option>
                                <option value="crypto">Cryptocurrency</option>
                            </select>
                            <label for="withdrawMethod">Metode Penarikan</label>
                        </div>
                    </div>
                </div>
                <div class="d-grid mt-3">
                    <button class="btn btn-primary" type="button">Tarik Dana</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transaction History -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Riwayat Transaksi</h5>
        <div class="d-flex gap-2">
            <div class="input-group" style="max-width: 200px;">
                <span class="input-group-text">Filter</span>
                <select class="form-select form-select-sm" id="transactionType">
                    <option value="all">Semua</option>
                    <option value="purchase">Pembelian</option>
                    <option value="deposit">Deposit</option>
                    <option value="withdrawal">Penarikan</option>
                    <option value="commission">Komisi</option>
                </select>
            </div>
            <a href="{{ route('user.finance.transactions') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
    </div>
    <div class="card-body">
        @if(isset($transactions) && count($transactions) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                            <td>
                                @if($transaction->type == 'purchase')
                                    <span class="badge bg-info">Pembelian</span>
                                @elseif($transaction->type == 'deposit')
                                    <span class="badge bg-success">Deposit</span>
                                @elseif($transaction->type == 'withdrawal')
                                    <span class="badge bg-warning text-dark">Penarikan</span>
                                @elseif($transaction->type == 'commission')
                                    <span class="badge bg-primary">Komisi</span>
                                @endif
                            </td>
                            <td>{{ $transaction->description }}</td>
                            <td class="{{ $transaction->amount > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $transaction->amount > 0 ? '+' : '' }}{{ $transaction->amount }} USD
                            </td>
                            <td>
                                @if($transaction->status == 'completed')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($transaction->status == 'pending')
                                    <span class="badge bg-warning text-dark">Tertunda</span>
                                @elseif($transaction->status == 'failed')
                                    <span class="badge bg-danger">Gagal</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        @else
            <p class="text-center py-3 mb-0">Tidak ada riwayat transaksi.</p>
        @endif
    </div>
</div>

<!-- Payment Methods -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Metode Pembayaran</h5>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
            <i class="fas fa-plus me-1"></i> Tambah Metode
        </button>
    </div>
    <div class="card-body">
        @if(isset($paymentMethods) && count($paymentMethods) > 0)
            <div class="row g-4">
                @foreach($paymentMethods as $method)
                <div class="col-md-6">
                    <div class="card h-100 border">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @if($method->type == 'credit_card')
                                    <div>
                                        <i class="fab fa-cc-visa fa-2x text-primary me-2"></i>
                                        <span class="fw-bold">•••• •••• •••• {{ $method->last_four }}</span>
                                    </div>
                                @elseif($method->type == 'paypal')
                                    <div>
                                        <i class="fab fa-paypal fa-2x text-primary me-2"></i>
                                        <span class="fw-bold">{{ $method->email }}</span>
                                    </div>
                                @elseif($method->type == 'bank_account')
                                    <div>
                                        <i class="fas fa-university fa-2x text-primary me-2"></i>
                                        <span class="fw-bold">{{ $method->bank_name }} - {{ $method->account_number }}</span>
                                    </div>
                                @elseif($method->type == 'crypto')
                                    <div>
                                        <i class="fab fa-bitcoin fa-2x text-primary me-2"></i>
                                        <span class="fw-bold">{{ $method->wallet_address }}</span>
                                    </div>
                                @endif
                                
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" type="button" id="paymentMethodDropdown{{ $loop->index }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="paymentMethodDropdown{{ $loop->index }}">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-trash-alt me-2"></i> Hapus</a></li>
                                        @if(!$method->is_default)
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-check me-2"></i> Jadikan Default</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-0">Ditambahkan: {{ $method->created_at->format('d M Y') }}</p>
                                </div>
                                @if($method->is_default)
                                    <span class="badge bg-success">Default</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                <h5>Tidak ada metode pembayaran</h5>
                <p class="text-muted">Tambahkan metode pembayaran untuk mempermudah transaksi.</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
                    <i class="fas fa-plus me-1"></i> Tambah Metode Pembayaran
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Add Payment Method Modal -->
<div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-labelledby="addPaymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentMethodModalLabel">Tambah Metode Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="paymentMethodTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="credit-card-tab" data-bs-toggle="tab" data-bs-target="#credit-card" type="button" role="tab" aria-controls="credit-card" aria-selected="true">Kartu Kredit</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bank-account-tab" data-bs-toggle="tab" data-bs-target="#bank-account" type="button" role="tab" aria-controls="bank-account" aria-selected="false">Rekening Bank</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="crypto-tab" data-bs-toggle="tab" data-bs-target="#crypto" type="button" role="tab" aria-controls="crypto" aria-selected="false">Cryptocurrency</button>
                    </li>
                </ul>
                <div class="tab-content pt-3" id="paymentMethodTabsContent">
                    <div class="tab-pane fade show active" id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab">
                        <form>
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">Nomor Kartu</label>
                                <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="expiryDate" class="form-label">Tanggal Kadaluarsa</label>
                                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                                </div>
                                <div class="col-md-6">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" placeholder="123">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="cardholderName" class="form-label">Nama Pemegang Kartu</label>
                                <input type="text" class="form-control" id="cardholderName" placeholder="John Doe">
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="bank-account" role="tabpanel" aria-labelledby="bank-account-tab">
                        <form>
                            <div class="mb-3">
                                <label for="bankName" class="form-label">Nama Bank</label>
                                <input type="text" class="form-control" id="bankName" placeholder="Nama Bank">
                            </div>
                            <div class="mb-3">
                                <label for="accountNumber" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control" id="accountNumber" placeholder="Nomor Rekening">
                            </div>
                            <div class="mb-3">
                                <label for="accountName" class="form-label">Nama Pemilik Rekening</label>
                                <input type="text" class="form-control" id="accountName" placeholder="Nama Pemilik Rekening">
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="crypto" role="tabpanel" aria-labelledby="crypto-tab">
                        <form>
                            <div class="mb-3">
                                <label for="cryptoType" class="form-label">Jenis Cryptocurrency</label>
                                <select class="form-select" id="cryptoType">
                                    <option value="btc">Bitcoin (BTC)</option>
                                    <option value="eth">Ethereum (ETH)</option>
                                    <option value="usdt">Tether (USDT)</option>
                                    <option value="bnb">Binance Coin (BNB)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="walletAddress" class="form-label">Alamat Wallet</label>
                                <input type="text" class="form-control" id="walletAddress" placeholder="Alamat Wallet">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="setAsDefault">
                    <label class="form-check-label" for="setAsDefault">
                        Jadikan sebagai metode pembayaran default
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
