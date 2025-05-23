@extends('layouts.dashboard')

@section('title', 'Sinyal Trading Saya')

@section('actions')
<a href="{{ route('user.signals.explore') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-search"></i> Jelajahi Sinyal
</a>
@endsection

@section('dashboard-content')
<!-- Active Signals -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sinyal Trading Aktif</h5>
        <a href="{{ route('user.signals.subscriptions') }}" class="btn btn-sm btn-outline-primary">Kelola Langganan</a>
    </div>
    <div class="card-body">
        @if(isset($activeSignals) && count($activeSignals) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Sinyal</th>
                            <th>Kategori</th>
                            <th>Penyedia</th>
                            <th>Status</th>
                            <th>Berakhir Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeSignals as $signal)
                        <tr>
                            <td>{{ $signal->name }}</td>
                            <td>{{ $signal->category }}</td>
                            <td>{{ $signal->provider }}</td>
                            <td>
                                <span class="badge bg-success">Aktif</span>
                            </td>
                            <td>{{ $signal->expires_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('user.signals.show', $signal->id) }}" class="btn btn-outline-primary">Detail</a>
                                    <a href="{{ route('user.signals.history', $signal->id) }}" class="btn btn-outline-secondary">Riwayat</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                <h5>Tidak ada sinyal trading aktif</h5>
                <p class="text-muted">Anda belum berlangganan sinyal trading apapun.</p>
                <a href="{{ route('user.signals.explore') }}" class="btn btn-primary">Jelajahi Sinyal Trading</a>
            </div>
        @endif
    </div>
</div>

<!-- Recent Signal Alerts -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Notifikasi Sinyal Terbaru</h5>
        <a href="{{ route('user.signals.alerts') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body">
        @if(isset($recentAlerts) && count($recentAlerts) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sinyal</th>
                            <th>Tipe</th>
                            <th>Aset</th>
                            <th>Harga Masuk</th>
                            <th>Target</th>
                            <th>Stop Loss</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentAlerts as $alert)
                        <tr>
                            <td>{{ $alert->signal_name }}</td>
                            <td>
                                @if($alert->type == 'buy')
                                    <span class="text-success"><i class="fas fa-arrow-up me-1"></i> Beli</span>
                                @else
                                    <span class="text-danger"><i class="fas fa-arrow-down me-1"></i> Jual</span>
                                @endif
                            </td>
                            <td>{{ $alert->asset }}</td>
                            <td>{{ $alert->entry_price }}</td>
                            <td>{{ $alert->target_price }}</td>
                            <td>{{ $alert->stop_loss }}</td>
                            <td>{{ $alert->created_at->format('d M Y H:i') }}</td>
                            <td>
                                @if($alert->status == 'active')
                                    <span class="badge bg-primary">Aktif</span>
                                @elseif($alert->status == 'target_reached')
                                    <span class="badge bg-success">Target Tercapai</span>
                                @elseif($alert->status == 'stop_loss')
                                    <span class="badge bg-danger">Stop Loss</span>
                                @else
                                    <span class="badge bg-secondary">Ditutup</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center py-3 mb-0">Tidak ada notifikasi sinyal terbaru.</p>
        @endif
    </div>
</div>

<!-- Signal Performance -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Performa Sinyal Trading</h5>
    </div>
    <div class="card-body">
        @if(isset($activeSignals) && count($activeSignals) > 0)
            <div class="row">
                <div class="col-md-8">
                    <canvas id="signalPerformanceChart" height="300"></canvas>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">Statistik Sinyal</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Sinyal
                                    <span class="badge bg-primary rounded-pill">{{ $stats->total_signals ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sinyal Sukses
                                    <span class="badge bg-success rounded-pill">{{ $stats->successful_signals ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sinyal Gagal
                                    <span class="badge bg-danger rounded-pill">{{ $stats->failed_signals ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tingkat Keberhasilan
                                    <span class="badge bg-info rounded-pill">{{ $stats->success_rate ?? 0 }}%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Profit Rata-rata
                                    <span class="badge bg-success rounded-pill">{{ $stats->avg_profit ?? 0 }}%</span>
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
                <p class="text-muted">Berlangganan sinyal trading untuk melihat data performa.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Only initialize chart if there are active signals
    @if(isset($activeSignals) && count($activeSignals) > 0)
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('signalPerformanceChart').getContext('2d');
        const signalPerformanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Tingkat Keberhasilan (%)',
                    data: [65, 70, 68, 75, 82, 80, 85, 88, 87, 90, 92, 95],
                    borderColor: 'rgba(37, 99, 235, 1)',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Profit (%)',
                    data: [5, 7, 6, 8, 10, 9, 12, 15, 14, 18, 20, 22],
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
    @endif
</script>
@endsection
