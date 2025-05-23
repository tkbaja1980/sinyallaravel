@extends('layouts.public')

@section('main-content')
<!-- Hero Section -->
<section class="hero-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-3">Platform Sinyal Trading & Bot Terpercaya</h1>
                <p class="lead mb-4">Tingkatkan performa trading Anda dengan sinyal akurat dan bot trading otomatis. Solusi lengkap untuk trader pemula hingga profesional.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 me-md-2">Daftar Gratis</a>
                    <a href="{{ route('products.explore') }}" class="btn btn-outline-light btn-lg px-4">Jelajahi Produk</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/hero-image.png') }}" alt="Trading Platform" class="img-fluid rounded shadow" onerror="this.src='https://via.placeholder.com/600x400?text=Trading+Platform'">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Fitur Unggulan Kami</h2>
            <p class="lead text-muted">Solusi trading terlengkap untuk meningkatkan performa investasi Anda</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-chart-line fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Sinyal Trading Akurat</h5>
                        <p class="card-text">Dapatkan sinyal trading terbaik untuk kripto, forex, dan saham dengan tingkat akurasi tinggi.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-robot fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Bot Trading Otomatis</h5>
                        <p class="card-text">Trading 24/7 dengan bot otomatis yang dapat dikonfigurasi sesuai strategi Anda.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-shield-alt fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Keamanan Terjamin</h5>
                        <p class="card-text">Sistem keamanan berlapis dan pembayaran kripto aman untuk melindungi investasi Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Produk Unggulan</h2>
            <p class="lead text-muted">Pilih produk yang sesuai dengan kebutuhan trading Anda</p>
        </div>
        
        <div class="row g-4">
            <!-- Signals Tab -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Sinyal Trading</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sinyal Kripto
                                <span class="badge bg-primary rounded-pill">Terbaru</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sinyal Forex
                                <span class="badge bg-primary rounded-pill">Populer</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sinyal Saham
                            </li>
                        </ul>
                        <div class="text-center">
                            <a href="{{ route('signals.index') }}" class="btn btn-outline-primary">Lihat Semua Sinyal</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bots Tab -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Bot Trading</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Bot Grid
                                <span class="badge bg-primary rounded-pill">Terlaris</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Bot DCA
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Bot Arbitrase
                                <span class="badge bg-primary rounded-pill">Baru</span>
                            </li>
                        </ul>
                        <div class="text-center">
                            <a href="{{ route('bots.index') }}" class="btn btn-outline-primary">Lihat Semua Bot</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Testimoni Pengguna</h2>
            <p class="lead text-muted">Apa kata mereka tentang platform kami</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text">"Sinyal trading yang sangat akurat dan bot yang mudah digunakan. Profit saya meningkat signifikan sejak menggunakan platform ini."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Budi Santoso</h6>
                                <small class="text-muted">Trader Forex</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text">"Sebagai trader pemula, platform ini sangat membantu saya memahami pasar dan menghasilkan profit konsisten dengan bot trading otomatis."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Siti Rahma</h6>
                                <small class="text-muted">Trader Kripto</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </div>
                        <p class="card-text">"Dukungan pelanggan yang responsif dan fitur referral yang menguntungkan. Saya telah mengajak banyak teman bergabung dan mendapatkan komisi yang besar."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Andi Wijaya</h6>
                                <small class="text-muted">Trader Saham</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="fw-bold">Siap Meningkatkan Performa Trading Anda?</h2>
                <p class="lead mb-0">Daftar sekarang dan dapatkan akses ke sinyal trading dan bot otomatis terbaik.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Daftar Gratis</a>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Artikel Terbaru</h2>
            <p class="lead text-muted">Wawasan dan tips trading terkini</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200?text=Trading+Article" class="card-img-top" alt="Article">
                    <div class="card-body">
                        <h5 class="card-title">Strategi Trading Kripto untuk Pemula</h5>
                        <p class="card-text">Pelajari dasar-dasar trading kripto dan strategi yang cocok untuk pemula.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                    </div>
                    <div class="card-footer text-muted">
                        <small>Dipublikasikan 3 hari yang lalu</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200?text=Trading+Article" class="card-img-top" alt="Article">
                    <div class="card-body">
                        <h5 class="card-title">Mengoptimalkan Bot Grid untuk Pasar Sideways</h5>
                        <p class="card-text">Tips dan trik menggunakan bot grid untuk memaksimalkan profit di pasar sideways.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                    </div>
                    <div class="card-footer text-muted">
                        <small>Dipublikasikan 1 minggu yang lalu</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x200?text=Trading+Article" class="card-img-top" alt="Article">
                    <div class="card-body">
                        <h5 class="card-title">Analisis Teknikal vs Fundamental dalam Trading</h5>
                        <p class="card-text">Perbandingan dua pendekatan analisis dan kapan sebaiknya menggunakan masing-masing.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                    </div>
                    <div class="card-footer text-muted">
                        <small>Dipublikasikan 2 minggu yang lalu</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('blog.index') }}" class="btn btn-primary">Lihat Semua Artikel</a>
        </div>
    </div>
</section>
@endsection
