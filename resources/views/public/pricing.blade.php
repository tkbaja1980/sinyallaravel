@extends('layouts.public')

@section('main-content')
<!-- Pricing Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">Harga & Paket</h1>
                <p class="lead mb-0">Pilih paket yang sesuai dengan kebutuhan trading Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Tabs -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <ul class="nav nav-pills justify-content-center" id="pricingTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="signals-tab" data-bs-toggle="pill" data-bs-target="#signals" type="button" role="tab" aria-controls="signals" aria-selected="true">Sinyal Trading</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bots-tab" data-bs-toggle="pill" data-bs-target="#bots" type="button" role="tab" aria-controls="bots" aria-selected="false">Bot Trading</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bundles-tab" data-bs-toggle="pill" data-bs-target="#bundles" type="button" role="tab" aria-controls="bundles" aria-selected="false">Paket Bundel</button>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="tab-content" id="pricingTabsContent">
            <!-- Signals Pricing -->
            <div class="tab-pane fade show active" id="signals" role="tabpanel" aria-labelledby="signals-tab">
                <div class="row g-4 py-3">
                    <!-- Basic Plan -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header text-center bg-light py-3">
                                <h4 class="my-0 fw-normal">Basic</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$29<small class="text-muted fw-light">/bulan</small></h1>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 1 Kategori Sinyal (Pilih: Kripto, Forex, atau Saham)</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 10-15 Sinyal per Bulan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Notifikasi Email</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Akses ke Grup Telegram</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Analisis Mendalam</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Sinyal Prioritas</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Dukungan Prioritas</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pro Plan -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow border border-primary">
                            <div class="card-header text-center bg-primary text-white py-3">
                                <h4 class="my-0 fw-normal">Pro</h4>
                                <span class="badge bg-warning text-dark mt-2">Terpopuler</span>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$59<small class="text-muted fw-light">/bulan</small></h1>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 2 Kategori Sinyal (Pilih 2 dari: Kripto, Forex, Saham)</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 20-30 Sinyal per Bulan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Notifikasi Email & SMS</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Akses ke Grup Telegram</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Analisis Mendalam</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Sinyal Prioritas</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Dukungan Prioritas</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Plan -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header text-center bg-light py-3">
                                <h4 class="my-0 fw-normal">Premium</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$99<small class="text-muted fw-light">/bulan</small></h1>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Semua Kategori Sinyal (Kripto, Forex, Saham)</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 40-50 Sinyal per Bulan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Notifikasi Email, SMS & Telegram Pribadi</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Akses ke Grup Telegram VIP</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Analisis Mendalam</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Sinyal Prioritas</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Prioritas 24/7</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bots Pricing -->
            <div class="tab-pane fade" id="bots" role="tabpanel" aria-labelledby="bots-tab">
                <div class="row g-4 py-3">
                    <!-- Basic Bot Plan -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header text-center bg-light py-3">
                                <h4 class="my-0 fw-normal">Basic Bot</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$49<small class="text-muted fw-light">/bulan</small></h1>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 1 Bot Trading (Pilih: Grid, DCA, atau Arbitrase)</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 1 Exchange Terintegrasi</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Konfigurasi Dasar</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Update Bulanan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Email</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Fitur Lanjutan</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Dukungan Prioritas</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pro Bot Plan -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow border border-primary">
                            <div class="card-header text-center bg-primary text-white py-3">
                                <h4 class="my-0 fw-normal">Pro Bot</h4>
                                <span class="badge bg-warning text-dark mt-2">Terpopuler</span>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$89<small class="text-muted fw-light">/bulan</small></h1>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 2 Bot Trading (Pilih 2 dari: Grid, DCA, Arbitrase)</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 3 Exchange Terintegrasi</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Konfigurasi Lanjutan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Update Mingguan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Email & Chat</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Fitur Lanjutan</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Dukungan Prioritas</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Bot Plan -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header text-center bg-light py-3">
                                <h4 class="my-0 fw-normal">Premium Bot</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$149<small class="text-muted fw-light">/bulan</small></h1>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Semua Bot Trading (Grid, DCA, Arbitrase)</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Semua Exchange Didukung</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Konfigurasi Profesional</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Update Prioritas</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Email, Chat & Telepon</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Semua Fitur Lanjutan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Prioritas 24/7</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bundle Pricing -->
            <div class="tab-pane fade" id="bundles" role="tabpanel" aria-labelledby="bundles-tab">
                <div class="row g-4 py-3">
                    <!-- Starter Bundle -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header text-center bg-light py-3">
                                <h4 class="my-0 fw-normal">Starter Bundle</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$69<small class="text-muted fw-light">/bulan</small></h1>
                                <p class="text-center text-success">Hemat 12%</p>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Basic Signal Plan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Basic Bot Plan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 1 Kategori Sinyal</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 1 Bot Trading</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Email</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Fitur Lanjutan</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Dukungan Prioritas</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pro Bundle -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow border border-primary">
                            <div class="card-header text-center bg-primary text-white py-3">
                                <h4 class="my-0 fw-normal">Pro Bundle</h4>
                                <span class="badge bg-warning text-dark mt-2">Terpopuler</span>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$129<small class="text-muted fw-light">/bulan</small></h1>
                                <p class="text-center text-success">Hemat 15%</p>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pro Signal Plan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pro Bot Plan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 2 Kategori Sinyal</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 2 Bot Trading</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Email & Chat</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Fitur Lanjutan</li>
                                    <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> Dukungan Prioritas</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Bundle -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header text-center bg-light py-3">
                                <h4 class="my-0 fw-normal">Premium Bundle</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title text-center">$199<small class="text-muted fw-light">/bulan</small></h1>
                                <p class="text-center text-success">Hemat 20%</p>
                                <ul class="list-unstyled mt-4 mb-5">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Premium Signal Plan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Premium Bot Plan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Semua Kategori Sinyal</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Semua Bot Trading</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Email, Chat & Telepon</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Semua Fitur Lanjutan</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dukungan Prioritas 24/7</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Comparison Table -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Perbandingan Fitur</h2>
            <p class="lead text-muted">Lihat perbandingan lengkap fitur di setiap paket</p>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Fitur</th>
                        <th scope="col" class="text-center">Basic</th>
                        <th scope="col" class="text-center bg-primary text-white">Pro</th>
                        <th scope="col" class="text-center">Premium</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" colspan="4" class="table-light">Sinyal Trading</th>
                    </tr>
                    <tr>
                        <td>Kategori Sinyal</td>
                        <td class="text-center">1 Kategori</td>
                        <td class="text-center">2 Kategori</td>
                        <td class="text-center">Semua Kategori</td>
                    </tr>
                    <tr>
                        <td>Jumlah Sinyal per Bulan</td>
                        <td class="text-center">10-15</td>
                        <td class="text-center">20-30</td>
                        <td class="text-center">40-50</td>
                    </tr>
                    <tr>
                        <td>Notifikasi Email</td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Notifikasi SMS</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Telegram Pribadi</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Analisis Mendalam</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="4" class="table-light">Bot Trading</th>
                    </tr>
                    <tr>
                        <td>Jumlah Bot</td>
                        <td class="text-center">1 Bot</td>
                        <td class="text-center">2 Bot</td>
                        <td class="text-center">Semua Bot</td>
                    </tr>
                    <tr>
                        <td>Exchange Terintegrasi</td>
                        <td class="text-center">1 Exchange</td>
                        <td class="text-center">3 Exchange</td>
                        <td class="text-center">Semua Exchange</td>
                    </tr>
                    <tr>
                        <td>Konfigurasi Lanjutan</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Update</td>
                        <td class="text-center">Bulanan</td>
                        <td class="text-center">Mingguan</td>
                        <td class="text-center">Prioritas</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="4" class="table-light">Dukungan</th>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Chat</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Dukungan Prioritas 24/7</td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                    </tr>
                </tbody>
            </table>
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
                <div class="accordion" id="pricingFAQ">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Apakah ada diskon untuk langganan jangka panjang?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#pricingFAQ">
                            <div class="accordion-body">
                                Ya, kami menawarkan diskon untuk langganan jangka panjang. Anda akan mendapatkan diskon 10% untuk langganan 3 bulan, 15% untuk langganan 6 bulan, dan 20% untuk langganan tahunan.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Metode pembayaran apa yang diterima?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#pricingFAQ">
                            <div class="accordion-body">
                                Kami menerima pembayaran melalui kartu kredit/debit (Visa, Mastercard, American Express), PayPal, dan berbagai cryptocurrency (Bitcoin, Ethereum, USDT, dll).
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Apakah ada jaminan uang kembali?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#pricingFAQ">
                            <div class="accordion-body">
                                Ya, kami menawarkan jaminan uang kembali 7 hari untuk semua paket. Jika Anda tidak puas dengan layanan kami, Anda dapat meminta pengembalian dana penuh dalam 7 hari pertama berlangganan.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Bisakah saya mengupgrade atau downgrade paket saya?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#pricingFAQ">
                            <div class="accordion-body">
                                Ya, Anda dapat mengupgrade paket Anda kapan saja dan hanya membayar selisih harga secara prorata. Untuk downgrade, perubahan akan berlaku pada periode penagihan berikutnya.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Apakah ada biaya tersembunyi?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#pricingFAQ">
                            <div class="accordion-body">
                                Tidak, semua biaya sudah termasuk dalam harga yang tercantum. Tidak ada biaya tersembunyi atau biaya tambahan. Harga yang Anda lihat adalah harga yang Anda bayar.
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
                <h2 class="fw-bold">Masih Ragu?</h2>
                <p class="lead mb-0">Hubungi tim kami untuk konsultasi gratis dan temukan paket yang tepat untuk Anda.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('support.contact') }}" class="btn btn-light btn-lg px-4">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>
@endsection
