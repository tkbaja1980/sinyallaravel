@extends('layouts.public')

@section('main-content')
<!-- Signals List Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3">Sinyal Trading</h1>
                <p class="lead mb-0">Dapatkan sinyal trading akurat untuk kripto, forex, dan saham dengan tingkat keberhasilan tinggi.</p>
            </div>
            <div class="col-lg-6 text-center text-lg-end">
                <img src="{{ asset('images/signals-hero.png') }}" alt="Sinyal Trading" class="img-fluid rounded shadow" style="max-width: 400px;" onerror="this.src='https://via.placeholder.com/400x250?text=Sinyal+Trading'">
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
                        <a class="nav-link {{ request()->is('signals') ? 'active' : '' }}" href="{{ route('signals.index') }}">Semua Sinyal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('signals/category/kripto') ? 'active' : '' }}" href="{{ route('signals.category', 'kripto') }}">Kripto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('signals/category/forex') ? 'active' : '' }}" href="{{ route('signals.category', 'forex') }}">Forex</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('signals/category/saham') ? 'active' : '' }}" href="{{ route('signals.category', 'saham') }}">Saham</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Signals List -->
<section class="py-5">
    <div class="container">
        <!-- Search and Sort -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari sinyal trading..." aria-label="Cari sinyal trading">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end">
                <div class="input-group" style="max-width: 250px;">
                    <label class="input-group-text" for="sortSignals">Urutkan</label>
                    <select class="form-select" id="sortSignals">
                        <option value="popular">Terpopuler</option>
                        <option value="newest">Terbaru</option>
                        <option value="price-low">Harga: Rendah ke Tinggi</option>
                        <option value="price-high">Harga: Tinggi ke Rendah</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Signals Grid -->
        <div class="row g-4">
            @if(isset($signals) && count($signals) > 0)
                @foreach($signals as $signal)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">{{ $signal->category }}</span>
                            @if($signal->featured)
                                <span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i> Unggulan</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $signal->name }}</h5>
                            <p class="card-text text-muted mb-3">{{ $signal->description }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="fas fa-chart-line text-primary me-1"></i> {{ $signal->market }}
                                </div>
                                <div>
                                    <i class="fas fa-user-tie text-primary me-1"></i> {{ $signal->provider }}
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="fw-bold">Akurasi:</span> {{ $signal->accuracy }}%
                                </div>
                                <div>
                                    <span class="fw-bold">Sinyal/Bulan:</span> {{ $signal->signals_per_month }}
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-success fw-bold fs-5">
                                    ${{ $signal->price }}/bulan
                                </div>
                                <a href="{{ route('signals.show', $signal->id) }}" class="btn btn-outline-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4>Tidak ada sinyal trading yang ditemukan</h4>
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

<!-- Why Choose Our Signals -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Memilih Sinyal Trading Kami?</h2>
            <p class="lead text-muted">Keunggulan sinyal trading yang kami tawarkan</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-chart-pie fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Akurasi Tinggi</h5>
                        <p class="card-text">Sinyal trading kami memiliki tingkat akurasi di atas 85% berdasarkan data historis.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-bell fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Notifikasi Real-time</h5>
                        <p class="card-text">Dapatkan notifikasi sinyal trading secara real-time melalui email, SMS, atau Telegram.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="fas fa-user-tie fa-2x p-3"></i>
                        </div>
                        <h5 class="card-title">Analis Profesional</h5>
                        <p class="card-text">Sinyal dibuat oleh tim analis profesional dengan pengalaman lebih dari 10 tahun di pasar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Testimoni Pengguna Sinyal Trading</h2>
            <p class="lead text-muted">Apa kata mereka tentang sinyal trading kami</p>
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
                        <p class="card-text">"Sinyal trading kripto sangat akurat dan membantu saya meningkatkan profit trading hingga 30% dalam sebulan terakhir."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Ahmad Rizki</h6>
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
                        <p class="card-text">"Sebagai trader forex pemula, sinyal trading ini sangat membantu saya memahami pasar dan mengambil keputusan dengan lebih percaya diri."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Dewi Anggraini</h6>
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
                        <p class="card-text">"Notifikasi real-time dan analisis mendalam yang menyertai setiap sinyal saham membuat saya bisa mengambil keputusan dengan cepat dan tepat."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">Budi Santoso</h6>
                                <small class="text-muted">Trader Saham</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pertanyaan Umum</h2>
            <p class="lead text-muted">Jawaban untuk pertanyaan yang sering diajukan</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="signalsFAQ">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Bagaimana cara berlangganan sinyal trading?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#signalsFAQ">
                            <div class="accordion-body">
                                Untuk berlangganan sinyal trading, Anda perlu mendaftar akun terlebih dahulu. Setelah login, pilih paket sinyal yang diinginkan dan lakukan pembayaran. Setelah pembayaran dikonfirmasi, Anda akan langsung mendapatkan akses ke sinyal trading sesuai paket yang dipilih.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Bagaimana sinyal trading dikirimkan?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#signalsFAQ">
                            <div class="accordion-body">
                                Sinyal trading dikirimkan melalui beberapa saluran: email, SMS, dan grup Telegram khusus member. Anda dapat mengatur preferensi notifikasi di dashboard akun Anda untuk memilih saluran yang paling nyaman.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Apakah ada jaminan profit dari sinyal trading?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#signalsFAQ">
                            <div class="accordion-body">
                                Kami tidak memberikan jaminan profit karena trading selalu memiliki risiko. Namun, sinyal kami memiliki tingkat akurasi tinggi berdasarkan data historis. Kami selalu menyarankan untuk menggunakan manajemen risiko yang baik dan tidak menginvestasikan dana yang tidak mampu Anda tanggung risikonya.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Berapa banyak sinyal yang akan saya terima per bulan?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#signalsFAQ">
                            <div class="accordion-body">
                                Jumlah sinyal bervariasi tergantung paket dan jenis pasar. Secara umum, untuk paket standar, Anda akan menerima 20-30 sinyal kripto, 15-20 sinyal forex, dan 10-15 sinyal saham per bulan. Detail lengkap dapat dilihat pada halaman detail masing-masing paket sinyal.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Apakah saya bisa membatalkan langganan kapan saja?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#signalsFAQ">
                            <div class="accordion-body">
                                Ya, Anda dapat membatalkan langganan kapan saja melalui dashboard akun Anda. Pembatalan akan efektif pada akhir periode langganan saat ini. Kami tidak memberikan pengembalian dana untuk periode langganan yang sedang berjalan.
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
                <h2 class="fw-bold">Siap Meningkatkan Performa Trading Anda?</h2>
                <p class="lead mb-0">Berlangganan sinyal trading kami sekarang dan rasakan perbedaannya!</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</section>
@endsection
