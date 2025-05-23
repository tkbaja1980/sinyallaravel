@extends('layouts.dashboard')

@section('title', 'Referral Saya')

@section('actions')
<a href="{{ route('user.referral.share') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-share-alt"></i> Bagikan Link Referral
</a>
@endsection

@section('dashboard-content')
<!-- Referral Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card dashboard-card bg-primary text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="title">Total Referral</div>
                <div class="value">{{ $stats->total_referrals ?? 0 }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-success text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="title">Referral Aktif</div>
                <div class="value">{{ $stats->active_referrals ?? 0 }}</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-info text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="title">Total Komisi</div>
                <div class="value">{{ $stats->total_commission ?? 0 }} USD</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card dashboard-card bg-warning text-white">
            <div class="card-body">
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="title">Komisi Tersedia</div>
                <div class="value">{{ $stats->available_commission ?? 0 }} USD</div>
            </div>
        </div>
    </div>
</div>

<!-- Referral Link -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Link Referral Saya</h5>
    </div>
    <div class="card-body">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="referralLink" value="{{ $referralLink ?? 'https://sinyaltrading.com/ref/ABC123' }}" readonly>
            <button class="btn btn-primary" type="button" id="copyButton" onclick="copyReferralLink()">
                <i class="fas fa-copy me-1"></i> Salin
            </button>
        </div>
        
        <div class="row g-4 mt-2">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-gift text-primary me-2"></i> Program Referral</h5>
                        <p class="card-text">Dapatkan komisi {{ $commissionRate ?? '20%' }} dari setiap pembelian yang dilakukan oleh pengguna yang Anda referensikan.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Komisi seumur hidup</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pembayaran instan</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Tanpa batasan jumlah referral</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-share-alt text-primary me-2"></i> Bagikan Link Referral</h5>
                        <p class="card-text">Bagikan link referral Anda melalui berbagai platform untuk mendapatkan lebih banyak referral.</p>
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            <a href="#" class="btn btn-outline-primary" onclick="shareOnFacebook()">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-outline-info" onclick="shareOnTwitter()">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-success" onclick="shareOnWhatsApp()">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary" onclick="shareOnTelegram()">
                                <i class="fab fa-telegram-plane"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger" onclick="shareOnEmail()">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Referral List -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Referral Saya</h5>
        <div class="input-group" style="max-width: 300px;">
            <input type="text" class="form-control form-control-sm" placeholder="Cari referral...">
            <button class="btn btn-sm btn-primary" type="button"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body">
        @if(isset($referrals) && count($referrals) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Bergabung</th>
                            <th>Status</th>
                            <th>Total Pembelian</th>
                            <th>Komisi Diterima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referrals as $referral)
                        <tr>
                            <td>{{ $referral->name }}</td>
                            <td>{{ $referral->joined_at->format('d M Y') }}</td>
                            <td>
                                @if($referral->status == 'active')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>{{ $referral->total_purchases }} USD</td>
                            <td>{{ $referral->commission_earned }} USD</td>
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
            <div class="text-center py-4">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5>Belum ada referral</h5>
                <p class="text-muted">Bagikan link referral Anda untuk mulai mendapatkan komisi.</p>
                <a href="{{ route('user.referral.share') }}" class="btn btn-primary">Bagikan Link Referral</a>
            </div>
        @endif
    </div>
</div>

<!-- Commission Transactions -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Riwayat Komisi</h5>
        <a href="{{ route('user.referral.commissions') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body">
        @if(isset($commissions) && count($commissions) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Referral</th>
                            <th>Produk</th>
                            <th>Jumlah Pembelian</th>
                            <th>Komisi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commissions as $commission)
                        <tr>
                            <td>{{ $commission->transaction_id }}</td>
                            <td>{{ $commission->referral_name }}</td>
                            <td>{{ $commission->product_name }}</td>
                            <td>{{ $commission->purchase_amount }} USD</td>
                            <td>{{ $commission->commission_amount }} USD</td>
                            <td>{{ $commission->created_at->format('d M Y') }}</td>
                            <td>
                                @if($commission->status == 'paid')
                                    <span class="badge bg-success">Dibayar</span>
                                @elseif($commission->status == 'pending')
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
            <p class="text-center py-3 mb-0">Belum ada riwayat komisi.</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    function copyReferralLink() {
        const referralLink = document.getElementById('referralLink');
        referralLink.select();
        document.execCommand('copy');
        
        const copyButton = document.getElementById('copyButton');
        const originalText = copyButton.innerHTML;
        copyButton.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin!';
        
        setTimeout(function() {
            copyButton.innerHTML = originalText;
        }, 2000);
    }
    
    function shareOnFacebook() {
        const referralLink = document.getElementById('referralLink').value;
        const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(referralLink)}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
    
    function shareOnTwitter() {
        const referralLink = document.getElementById('referralLink').value;
        const shareText = 'Dapatkan sinyal trading dan bot trading terbaik di SinyalTrading! Gunakan link referral saya untuk mendaftar:';
        const shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(referralLink)}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
    
    function shareOnWhatsApp() {
        const referralLink = document.getElementById('referralLink').value;
        const shareText = 'Dapatkan sinyal trading dan bot trading terbaik di SinyalTrading! Gunakan link referral saya untuk mendaftar: ' + referralLink;
        const shareUrl = `https://wa.me/?text=${encodeURIComponent(shareText)}`;
        window.open(shareUrl, '_blank');
    }
    
    function shareOnTelegram() {
        const referralLink = document.getElementById('referralLink').value;
        const shareText = 'Dapatkan sinyal trading dan bot trading terbaik di SinyalTrading! Gunakan link referral saya untuk mendaftar:';
        const shareUrl = `https://t.me/share/url?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent(shareText)}`;
        window.open(shareUrl, '_blank');
    }
    
    function shareOnEmail() {
        const referralLink = document.getElementById('referralLink').value;
        const subject = 'Rekomendasi SinyalTrading - Platform Sinyal dan Bot Trading';
        const body = `Halo,\n\nSaya ingin merekomendasikan SinyalTrading, platform sinyal trading dan bot trading terbaik yang pernah saya gunakan.\n\nGunakan link referral saya untuk mendaftar: ${referralLink}\n\nSalam,`;
        const mailtoUrl = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        window.location.href = mailtoUrl;
    }
</script>
@endsection
