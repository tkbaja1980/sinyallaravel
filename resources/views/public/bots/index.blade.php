@extends('layouts.public')

@section('main-content')
<!-- Bots List Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3">Bot Trading</h1>
                <p class="lead mb-0">Otomatisasi strategi trading Anda dengan bot trading canggih yang bekerja 24/7.</p>
            </div>
            <div class="col-lg-6 text-center text-lg-end">
                <img src="{{ asset('images/bots-hero.png') }}" alt="Bot Trading" class="img-fluid rounded shadow" style="max-width: 400px;" onerror="this.src='https://via.placeholder.com/400x250?text=Bot+Trading'">
            </div>
        </div>
    </div>
</section>

<!-- Category Filter -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bots') ? 'active' : '' }}" href="{{ route('bots.index') }}">Semua Bot</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bots/category/grid') ? 'active' : '' }}" href="{{ route('bots.category', 'grid') }}">Bot Grid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bots/category/dca') ? 'active' : '' }}" href="{{ route('bots.category', 'dca') }}">Bot DCA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bots/category/arbitrase') ? 'active' : '' }}" href="{{ route('bots.category', 'arbitrase') }}">Bot Arbitrase</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Bots List -->
<section class="py-5">
    <div class="container">
        <!-- Search and Sort -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari bot trading..." aria-label="Cari bot trading">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                <div class="input-group" style="max-width: 250px;">
                    <label class="input-group-text" for="sortBots">Urutkan</label>
                    <select class="form-select" id="sortBots">
                        <option value="popular">Terpopuler</option>
                        <option value="newest">Terbaru</option>
                        <option value="price-low">Harga: Rendah ke Tinggi</option>
                        <option value="price-high">Harga: Tinggi ke Rendah</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Bots Grid -->
        <div class="row g-4">
            @if(isset($bots) && count($bots) > 0)
                @foreach($bots as $bot)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">{{ $bot->category }}</span>
                            @if($bot->featured)
                                <span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i> Unggulan</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $bot->name }}</h5>
                            <p class="card-text text-muted mb-3">{{ $bot->description }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="fas fa-code-branch text-primary me-1"></i> Versi {{ $bot->version }}
                                </div>
                                <div>
                                    <i class="fas fa-exchange-alt text-primary me-1"></i> {{ $bot->compatible_exchanges }}
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="mb-2">Fitur Utama:</h6>
                                <ul class="list-unstyled">
                                    @foreach(explode(',', $bot->features) as $feature)
                                    <li><i class="fas fa-check text-success me-2"></i> {{ trim($feature) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-success fw-bold fs-5">
                                    ${{ $bot->price }}/bulan
                                </div>
                                <a href="{{ route('bots.show', $bot->id) }}" class="btn btn-outline-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <i class="fas fa-robot fa-3x text-muted mb-3"></i>
                    <h4>Tidak ada bot trading yang ditemukan</h4>
                    <p class="text-muted">Coba ubah filter pencarian Anda atau lihat kategori lainnya.</p>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Our Bots -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Memilih Bot Trading Kami?</h2>
            <p class="lead text-muted">Keunggulan bot trading yang kami tawarkan</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-clock fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Trading 24/7</h5>
                        <p class="card-text">Bot kami bekerja sepanjang waktu tanpa istirahat, memanfaatkan setiap peluang trading yang muncul.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-sliders-h fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Konfigurasi Fleksibel</h5>
                        <p class="card-text">Sesuaikan parameter bot sesuai dengan strategi dan toleransi risiko Anda dengan mudah.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-shield-alt fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Keamanan Terjamin</h5>
                        <p class="card-text">Bot kami beroperasi melalui API key dengan izin terbatas dan tidak pernah mengakses dana Anda secara langsung.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Cara Kerja Bot Trading</h2>
            <p class="lead text-muted">Langkah-langkah mudah untuk memulai dengan bot trading kami</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle mb-3" style="width: 50px; height: 50px; line-height: 50px; margin: 0 auto;">
                            <span class="fw-bold">1</span>
                        </div>
                        <h5 class="card-title">Beli Lisensi Bot</h5>
                        <p class="card-text">Pilih bot trading yang sesuai dengan kebutuhan Anda dan beli lisensinya.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle mb-3" style="width: 50px; height: 50px; line-height: 50px; margin: 0 auto;">
                            <span class="fw-bold">2</span>
                        </div>
                        <h5 class="card-title">Unduh & Instal</h5>
                        <p class="card-text">Unduh bot dari dashboard Anda dan ikuti panduan instalasi yang disediakan.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle mb-3" style="width: 50px; height: 50px; line-height: 50px; margin: 0 auto;">
                            <span class="fw-bold">3</span>
                        </div>
                        <h5 class="card-title">Konfigurasi Bot</h5>
                        <p class="card-text">Sesuaikan parameter bot dengan strategi trading dan toleransi risiko Anda.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle mb-3" style="width: 50px; height: 50px; line-height: 50px; margin: 0 auto;">
                            <span class="fw-bold">4</span>
                        </div>
                        <h5 class="card-title">Aktifkan & Monitor</h5>
                        <p class="card-text">Aktifkan bot dan pantau kinerjanya melalui dashboard yang disediakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Testimoni Pengguna Bot Trading</h2>
            <p class="lead text-muted">Apa kata mereka tentang bot trading kami</p>
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
                        <p class="card-text">"Bot Grid sangat membantu saya menghasilkan profit konsisten di pasar sideways. Setup mudah dan dukungan teknis sangat responsif."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Rudi Hartono</h6>
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
                        <p class="card-text">"Bot DCA telah mengubah cara saya berinvestasi. Saya tidak perlu lagi khawatir tentang waktu yang tepat untuk membeli, bot melakukannya untuk saya."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Nina Wijaya</h6>
                                <small class="text-muted">Investor Kripto</small>
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
                        <p class="card-text">"Bot Arbitrase bekerja sangat baik dalam memanfaatkan perbedaan harga antar exchange. ROI saya mencapai 15% dalam sebulan pertama penggunaan."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Andi Pratama</h6>
                                <small class="text-muted">Trader Profesional</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pertanyaan Umum</h2>
            <p class="lead text-muted">Jawaban untuk pertanyaan yang sering diajukan</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="botsFAQ">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Apakah saya perlu memiliki pengetahuan teknis untuk menggunakan bot?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#botsFAQ">
                            <div class="accordion-body">
                                Tidak, bot kami dirancang dengan antarmuka yang user-friendly dan panduan instalasi yang jelas. Anda tidak perlu memiliki pengetahuan pemrograman untuk menggunakannya. Namun, pemahaman dasar tentang trading dan strategi yang digunakan oleh bot akan sangat membantu.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Di exchange mana saja bot ini dapat digunakan?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#botsFAQ">
                            <div class="accordion-body">
                                Bot kami kompatibel dengan berbagai exchange populer seperti Binance, Coinbase Pro, KuCoin, Huobi, dan OKEx. Daftar lengkap exchange yang didukung dapat dilihat pada halaman detail masing-masing bot.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Bagaimana dengan keamanan dana saya?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#botsFAQ">
                            <div class="accordion-body">
                                Keamanan adalah prioritas utama kami. Bot kami beroperasi melalui API key dengan izin terbatas (hanya trading, tanpa penarikan) dan tidak pernah mengakses dana Anda secara langsung. Semua data sensitif dienkripsi dan bot berjalan di perangkat Anda sendiri, bukan di server kami.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Apakah ada jaminan profit dari bot trading?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#botsFAQ">
                            <div class="accordion-body">
                                Kami tidak memberikan jaminan profit karena trading selalu memiliki risiko. Performa bot bergantung pada kondisi pasar dan konfigurasi yang Anda pilih. Kami menyarankan untuk memulai dengan modal kecil dan menyesuaikan parameter bot secara bertahap sesuai dengan toleransi risiko Anda.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Bagaimana cara mendapatkan update bot terbaru?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#botsFAQ">
                            <div class="accordion-body">
                                Semua pengguna dengan lisensi aktif akan mendapatkan notifikasi dan akses ke update bot terbaru melalui dashboard mereka. Update mencakup perbaikan bug, peningkatan performa, dan fitur-fitur baru yang kami tambahkan secara berkala.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="fw-bold">Siap Mengotomatisasi Trading Anda?</h2>
                <p class="lead mb-0">Dapatkan bot trading kami sekarang dan nikmati trading 24/7 tanpa emosi!</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</section>
@endsection
