@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('actions')
<a href="{{ route('admin.settings.general') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-cog"></i> Pengaturan
</a>
@endsection

@section('admin-content')
<!-- KPI Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card dashboard-card bg-primary text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="title">Total Pengguna</div>
                <div class="value">{{ $totalUsers ?? 0 }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-success text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="title">Total Penjualan</div>
                <div class="value">{{ $totalSales ?? 0 }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-info text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="title">Pendapatan Bulan Ini</div>
                <div class="value">{{ $monthlyRevenue ?? 0 }} USD</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-warning text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="title">Tiket Dukungan Terbuka</div>
                <div class="value">{{ $openTickets ?? 0 }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tren Penjualan & Pendapatan</h5>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Hari Ini</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary active">Minggu Ini</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Bulan Ini</button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="salesRevenueChart" height="250"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Produk Terlaris</h5>
            </div>
            <div class="card-body">
                <canvas id="topProductsChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities & System Alerts -->
<div class="row g-4">
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Aktivitas Terbaru di Platform</h5>
                <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Aktivitas</th>
                                <th>Pengguna</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($recentActivities) && count($recentActivities) > 0)
                                @foreach($recentActivities as $activity)
                                <tr>
                                    <td>
                                        @if($activity->type == 'login')
                                            <i class="fas fa-sign-in-alt text-primary me-2"></i>
                                        @elseif($activity->type == 'purchase')
                                            <i class="fas fa-shopping-cart text-success me-2"></i>
                                        @elseif($activity->type == 'registration')
                                            <i class="fas fa-user-plus text-info me-2"></i>
                                        @else
                                            <i class="fas fa-bell text-warning me-2"></i>
                                        @endif
                                        {{ $activity->description }}
                                    </td>
                                    <td>{{ $activity->user_name }}</td>
                                    <td>{{ $activity->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada aktivitas terbaru.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Notifikasi Sistem & Peringatan Keamanan</h5>
                <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                @if(isset($systemAlerts) && count($systemAlerts) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($systemAlerts as $alert)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                @if($alert->level == 'critical')
                                    <i class="fas fa-exclamation-circle text-danger me-2"></i>
                                @elseif($alert->level == 'warning')
                                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                @else
                                    <i class="fas fa-info-circle text-info me-2"></i>
                                @endif
                                <span>{{ $alert->message }}</span>
                            </div>
                            <span class="badge bg-light text-dark">{{ $alert->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center mb-0">Tidak ada peringatan sistem saat ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Registrations & Transactions -->
<div class="row g-4 mt-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pendaftaran Pengguna Terbaru</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                @if(isset($recentUsers) && count($recentUsers) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($user->is_active)
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
                    <p class="text-center mb-0">Tidak ada pendaftaran pengguna terbaru.</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Transaksi Terbaru</h5>
                <a href="{{ route('admin.finance.transactions') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                @if(isset($recentTransactions) && count($recentTransactions) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pengguna</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->user_name }}</td>
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
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sales & Revenue Chart
    const salesRevenueCtx = document.getElementById('salesRevenueChart').getContext('2d');
    const salesRevenueChart = new Chart(salesRevenueCtx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Penjualan',
                data: [12, 19, 15, 17, 22, 25, 32],
                borderColor: 'rgba(37, 99, 235, 1)',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }, {
                label: 'Pendapatan',
                data: [1200, 1900, 1500, 1700, 2200, 2500, 3200],
                borderColor: 'rgba(16, 185, 129, 1)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // Top Products Chart
    const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
    const topProductsChart = new Chart(topProductsCtx, {
        type: 'doughnut',
        data: {
            labels: ['Bot Grid', 'Sinyal Kripto', 'Bot DCA', 'Sinyal Forex', 'Bot Arbitrase'],
            datasets: [{
                data: [35, 25, 20, 15, 5],
                backgroundColor: [
                    'rgba(37, 99, 235, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(139, 92, 246, 0.8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
