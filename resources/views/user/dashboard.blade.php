@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('actions')
<a href="{{ route('products.explore') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-search"></i> Jelajahi Produk
</a>
@endsection

@section('dashboard-content')
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card dashboard-card bg-primary text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="title">Sinyal Aktif</div>
                <div class="value">{{ $activeSignals ?? 0 }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-success text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="title">Bot Aktif</div>
                <div class="value">{{ $activeBots ?? 0 }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-info text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="title">Referral</div>
                <div class="value">{{ $totalReferrals ?? 0 }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-warning text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="title">Komisi Referral</div>
                <div class="value">{{ $referralCommission ?? 0 }} USD</div>
            </div>
        </div>
    </div>
</div>

<!-- Notifications & Announcements -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Notifikasi Penting & Pengumuman</h5>
        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body">
        @if(isset($notifications) && count($notifications) > 0)
            <ul class="list-group list-group-flush">
                @foreach($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-bell text-primary me-2"></i>
                        <span>{{ $notification->title }}</span>
                        <p class="text-muted small mb-0">{{ $notification->message }}</p>
                    </div>
                    <span class="badge bg-light text-dark">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
                @endforeach
            </ul>
        @else
            <p class="text-center mb-0">Tidak ada notifikasi baru.</p>
        @endif
    </div>
</div>

<div class="row g-4">
    <!-- Recent Signals -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sinyal Trading Terbaru</h5>
                <a href="{{ route('user.signals.subscriptions') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                @if(isset($recentSignals) && count($recentSignals) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Sinyal</th>
                                    <th>Pasar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSignals as $signal)
                                <tr>
                                    <td>{{ $signal->name }}</td>
                                    <td>{{ $signal->market }}</td>
                                    <td>
                                        @if($signal->status == 'active')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center mb-0">Tidak ada sinyal trading aktif.</p>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Recent Bots -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Bot Trading Terbaru</h5>
                <a href="{{ route('user.bots.list') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                @if(isset($recentBots) && count($recentBots) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Bot</th>
                                    <th>Versi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBots as $bot)
                                <tr>
                                    <td>{{ $bot->name }}</td>
                                    <td>{{ $bot->version }}</td>
                                    <td>
                                        @if($bot->status == 'active')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center mb-0">Tidak ada bot trading aktif.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Transaksi Terbaru</h5>
        <a href="{{ route('user.finance.transactions') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body">
        @if(isset($recentTransactions) && count($recentTransactions) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTransactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->created_at->format('d M Y') }}</td>
                            <td>{{ $transaction->product_name }}</td>
                            <td>{{ $transaction->amount }} USD</td>
                            <td>
                                @if($transaction->status == 'completed')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($transaction->status == 'pending')
                                    <span class="badge bg-warning text-dark">Tertunda</span>
                                @else
                                    <span class="badge bg-danger">Gagal</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center mb-0">Tidak ada transaksi terbaru.</p>
        @endif
    </div>
</div>
@endsection
