@extends('layouts.dashboard')

@section('title', 'Bot Trading Saya')

@section('actions')
<a href="{{ route('user.bots.explore') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-search"></i> Jelajahi Bot
</a>
@endsection

@section('dashboard-content')
<!-- Active Bots -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Bot Trading Aktif</h5>
        <a href="{{ route('user.bots.licenses') }}" class="btn btn-sm btn-outline-primary">Kelola Lisensi</a>
    </div>
    <div class="card-body">
        @if(isset($activeBots) && count($activeBots) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Bot</th>
                            <th>Kategori</th>
                            <th>Versi</th>
                            <th>Status</th>
                            <th>Berakhir Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeBots as $bot)
                        <tr>
                            <td>{{ $bot->name }}</td>
                            <td>{{ $bot->category }}</td>
                            <td>v{{ $bot->version }}</td>
                            <td>
                                @if($bot->status == 'running')
                                    <span class="badge bg-success">Berjalan</span>
                                @elseif($bot->status == 'paused')
                                    <span class="badge bg-warning text-dark">Dijeda</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>{{ $bot->expires_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('user.bots.show', $bot->id) }}" class="btn btn-outline-primary">Detail</a>
                                    <a href="{{ route('user.bots.configure', $bot->id) }}" class="btn btn-outline-secondary">Konfigurasi</a>
                                    <button type="button" class="btn btn-outline-success" onclick="toggleBotStatus({{ $bot->id }})">
                                        @if($bot->status == 'running')
                                            <i class="fas fa-pause"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-robot fa-3x text-muted mb-3"></i>
                <h5>Tidak ada bot trading aktif</h5>
                <p class="text-muted">Anda belum memiliki lisensi bot trading apapun.</p>
                <a href="{{ route('user.bots.explore') }}" class="btn btn-primary">Jelajahi Bot Trading</a>
            </div>
        @endif
    </div>
</div>

<!-- Bot Performance -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Performa Bot Trading</h5>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-secondary active">Hari Ini</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Minggu Ini</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Bulan Ini</button>
        </div>
    </div>
    <div class="card-body">
        @if(isset($activeBots) && count($activeBots) > 0)
            <div class="row">
                <div class="col-md-8">
                    <canvas id="botPerformanceChart" height="300"></canvas>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">Statistik Bot</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Transaksi
                                    <span class="badge bg-primary rounded-pill">{{ $stats->total_trades ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Transaksi Profit
                                    <span class="badge bg-success rounded-pill">{{ $stats->profitable_trades ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Transaksi Rugi
                                    <span class="badge bg-danger rounded-pill">{{ $stats->loss_trades ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tingkat Keberhasilan
                                    <span class="badge bg-info rounded-pill">{{ $stats->success_rate ?? 0 }}%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Profit
                                    <span class="badge bg-success rounded-pill">{{ $stats->total_profit ?? 0 }} USD</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                <h5>Tidak ada data performa</h5>
                <p class="text-muted">Aktifkan bot trading untuk melihat data performa.</p>
            </div>
        @endif
    </div>
</div>

<!-- Recent Bot Transactions -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Transaksi Bot Terbaru</h5>
        <a href="{{ route('user.bots.transactions') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body">
        @if(isset($recentTransactions) && count($recentTransactions) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Bot</th>
                            <th>Tipe</th>
                            <th>Aset</th>
                            <th>Harga Masuk</th>
                            <th>Harga Keluar</th>
                            <th>Jumlah</th>
                            <th>Profit/Loss</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTransactions as $transaction)
                        <tr>
                            <td>{{ $transaction->bot_name }}</td>
                            <td>
                                @if($transaction->type == 'buy')
                                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i> Beli</span>
                                @else
                                    <span class="text-danger"><i class="fas fa-arrow-down me-1"></i> Jual</span>
                                @endif
                            </td>
                            <td>{{ $transaction->asset }}</td>
                            <td>{{ $transaction->entry_price }}</td>
                            <td>{{ $transaction->exit_price }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td class="{{ $transaction->profit > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $transaction->profit > 0 ? '+' : '' }}{{ $transaction->profit }} USD
                            </td>
                            <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center py-3 mb-0">Tidak ada transaksi bot terbaru.</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Only initialize chart if there are active bots
    @if(isset($activeBots) && count($activeBots) > 0)
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('botPerformanceChart').getContext('2d');
        const botPerformanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00'],
                datasets: [{
                    label: 'Profit (USD)',
                    data: [0, 5, 12, 18, 25, 30, 35, 42],
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
    });
    
    // Function to toggle bot status
    function toggleBotStatus(botId) {
        // This would be an AJAX call to your backend
        console.log(`Toggling status for bot ID: ${botId}`);
        // After successful toggle, you would update the UI accordingly
    }
    @endif
</script>
@endsection
