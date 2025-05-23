@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="SinyalTrading Logo" class="img-fluid mb-3" style="max-width: 150px;" onerror="this.src='https://via.placeholder.com/150x40?text=SinyalTrading'">
                    <h6 class="mb-0">Admin Panel</h6>
                    <small class="text-muted">{{ Auth::user()->name }}</small>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dasbor Admin Utama
                        </a>
                    </li>
                    
                    <!-- Manajemen Pengguna -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#usersCollapse" role="button" aria-expanded="false" aria-controls="usersCollapse">
                            <i class="fas fa-users"></i> Manajemen Pengguna
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="usersCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                        <i class="fas fa-list"></i> Daftar Semua Pengguna
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.users.create') ? 'active' : '' }}" href="{{ route('admin.users.create') }}">
                                        <i class="fas fa-user-plus"></i> Tambah Pengguna Baru
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                                        <i class="fas fa-user-tag"></i> Manajemen Peran & Izin
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.users.groups') ? 'active' : '' }}" href="{{ route('admin.users.groups') }}">
                                        <i class="fas fa-users-cog"></i> Grup Pengguna
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.users.import') ? 'active' : '' }}" href="{{ route('admin.users.import') }}">
                                        <i class="fas fa-file-import"></i> Impor/Ekspor Data Pengguna
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Manajemen Katalog Produk -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#productsCollapse" role="button" aria-expanded="false" aria-controls="productsCollapse">
                            <i class="fas fa-box"></i> Manajemen Katalog Produk
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.products.*') ? 'show' : '' }}" id="productsCollapse">
                            <ul class="nav flex-column ms-3">
                                <!-- Sinyal Trading -->
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.products.signals.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#signalsAdminCollapse" role="button" aria-expanded="false" aria-controls="signalsAdminCollapse">
                                        <i class="fas fa-chart-line"></i> Sinyal Trading
                                    </a>
                                    <div class="collapse {{ request()->routeIs('admin.products.signals.*') ? 'show' : '' }}" id="signalsAdminCollapse">
                                        <ul class="nav flex-column ms-3">
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.signals.index') ? 'active' : '' }}" href="{{ route('admin.products.signals.index') }}">
                                                    <i class="fas fa-list"></i> Daftar Semua Sinyal
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.signals.create') ? 'active' : '' }}" href="{{ route('admin.products.signals.create') }}">
                                                    <i class="fas fa-plus"></i> Tambah Sinyal Baru
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.signals.categories') ? 'active' : '' }}" href="{{ route('admin.products.signals.categories') }}">
                                                    <i class="fas fa-tags"></i> Manajemen Kategori Sinyal
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.signals.providers') ? 'active' : '' }}" href="{{ route('admin.products.signals.providers') }}">
                                                    <i class="fas fa-user-tie"></i> Manajemen Penyedia Sinyal
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                
                                <!-- Bot Trading -->
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.products.bots.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#botsAdminCollapse" role="button" aria-expanded="false" aria-controls="botsAdminCollapse">
                                        <i class="fas fa-robot"></i> Bot Trading
                                    </a>
                                    <div class="collapse {{ request()->routeIs('admin.products.bots.*') ? 'show' : '' }}" id="botsAdminCollapse">
                                        <ul class="nav flex-column ms-3">
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.bots.index') ? 'active' : '' }}" href="{{ route('admin.products.bots.index') }}">
                                                    <i class="fas fa-list"></i> Daftar Semua Bot
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.bots.create') ? 'active' : '' }}" href="{{ route('admin.products.bots.create') }}">
                                                    <i class="fas fa-plus"></i> Tambah Bot Baru
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.bots.files') ? 'active' : '' }}" href="{{ route('admin.products.bots.files') }}">
                                                    <i class="fas fa-file-upload"></i> Unggah & Kelola File Bot
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.bots.licenses') ? 'active' : '' }}" href="{{ route('admin.products.bots.licenses') }}">
                                                    <i class="fas fa-key"></i> Sistem Manajemen Kunci Lisensi
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.products.bots.categories') ? 'active' : '' }}" href="{{ route('admin.products.bots.categories') }}">
                                                    <i class="fas fa-tags"></i> Manajemen Kategori Bot
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.products.attributes') ? 'active' : '' }}" href="{{ route('admin.products.attributes') }}">
                                        <i class="fas fa-sliders-h"></i> Atribut & Variasi Produk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.products.reviews') ? 'active' : '' }}" href="{{ route('admin.products.reviews') }}">
                                        <i class="fas fa-star"></i> Ulasan & Peringkat Produk
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Manajemen Konten & Halaman -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#contentCollapse" role="button" aria-expanded="false" aria-controls="contentCollapse">
                            <i class="fas fa-file-alt"></i> Manajemen Konten & Halaman
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.content.*') ? 'show' : '' }}" id="contentCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.content.pages.*') ? 'active' : '' }}" href="{{ route('admin.content.pages.index') }}">
                                        <i class="fas fa-file"></i> Manajemen Halaman Statis
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.content.blog.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#blogCollapse" role="button" aria-expanded="false" aria-controls="blogCollapse">
                                        <i class="fas fa-blog"></i> Manajemen Blog & Artikel
                                    </a>
                                    <div class="collapse {{ request()->routeIs('admin.content.blog.*') ? 'show' : '' }}" id="blogCollapse">
                                        <ul class="nav flex-column ms-3">
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.content.blog.posts') ? 'active' : '' }}" href="{{ route('admin.content.blog.posts') }}">
                                                    <i class="fas fa-list"></i> Daftar Artikel
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.content.blog.categories') ? 'active' : '' }}" href="{{ route('admin.content.blog.categories') }}">
                                                    <i class="fas fa-folder"></i> Kategori Blog & Tag
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->routeIs('admin.content.blog.comments') ? 'active' : '' }}" href="{{ route('admin.content.blog.comments') }}">
                                                    <i class="fas fa-comments"></i> Moderasi Komentar Blog
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.content.news') ? 'active' : '' }}" href="{{ route('admin.content.news') }}">
                                        <i class="fas fa-newspaper"></i> Manajemen Berita & Pengumuman
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.content.banners') ? 'active' : '' }}" href="{{ route('admin.content.banners') }}">
                                        <i class="fas fa-image"></i> Manajemen Banner & Promosi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.content.menus') ? 'active' : '' }}" href="{{ route('admin.content.menus') }}">
                                        <i class="fas fa-bars"></i> Manajemen Menu Navigasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.content.media') ? 'active' : '' }}" href="{{ route('admin.content.media') }}">
                                        <i class="fas fa-photo-video"></i> Pustaka Media
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.content.seo') ? 'active' : '' }}" href="{{ route('admin.content.seo') }}">
                                        <i class="fas fa-search"></i> Pengaturan SEO
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Keuangan & Transaksi -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.finance.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#financeAdminCollapse" role="button" aria-expanded="false" aria-controls="financeAdminCollapse">
                            <i class="fas fa-money-bill-wave"></i> Keuangan & Transaksi
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.finance.*') ? 'show' : '' }}" id="financeAdminCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.finance.transactions') ? 'active' : '' }}" href="{{ route('admin.finance.transactions') }}">
                                        <i class="fas fa-exchange-alt"></i> Daftar Semua Transaksi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.finance.reports') ? 'active' : '' }}" href="{{ route('admin.finance.reports') }}">
                                        <i class="fas fa-chart-bar"></i> Laporan Penjualan & Pendapatan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.finance.subscriptions') ? 'active' : '' }}" href="{{ route('admin.finance.subscriptions') }}">
                                        <i class="fas fa-sync"></i> Manajemen Langganan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.finance.refunds') ? 'active' : '' }}" href="{{ route('admin.finance.refunds') }}">
                                        <i class="fas fa-undo"></i> Manajemen Pengembalian Dana
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.finance.commissions') ? 'active' : '' }}" href="{{ route('admin.finance.commissions') }}">
                                        <i class="fas fa-hand-holding-usd"></i> Manajemen Pembayaran Komisi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.finance.export') ? 'active' : '' }}" href="{{ route('admin.finance.export') }}">
                                        <i class="fas fa-file-export"></i> Ekspor Laporan Keuangan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Program Referral (Admin) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.referral.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#referralAdminCollapse" role="button" aria-expanded="false" aria-controls="referralAdminCollapse">
                            <i class="fas fa-users"></i> Program Referral
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.referral.*') ? 'show' : '' }}" id="referralAdminCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.referral.config') ? 'active' : '' }}" href="{{ route('admin.referral.config') }}">
                                        <i class="fas fa-cog"></i> Konfigurasi Program
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.referral.list') ? 'active' : '' }}" href="{{ route('admin.referral.list') }}">
                                        <i class="fas fa-list"></i> Daftar Perujuk & Referral
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.referral.commissions') ? 'active' : '' }}" href="{{ route('admin.referral.commissions') }}">
                                        <i class="fas fa-check-circle"></i> Persetujuan & Pembayaran Komisi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.referral.fraud') ? 'active' : '' }}" href="{{ route('admin.referral.fraud') }}">
                                        <i class="fas fa-shield-alt"></i> Deteksi Aktivitas Penipuan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Dukungan Pelanggan -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.support.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#supportAdminCollapse" role="button" aria-expanded="false" aria-controls="supportAdminCollapse">
                            <i class="fas fa-headset"></i> Dukungan Pelanggan
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.support.*') ? 'show' : '' }}" id="supportAdminCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.support.tickets') ? 'active' : '' }}" href="{{ route('admin.support.tickets') }}">
                                        <i class="fas fa-ticket-alt"></i> Dasbor Tiket Dukungan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.support.agents') ? 'active' : '' }}" href="{{ route('admin.support.agents') }}">
                                        <i class="fas fa-user-headset"></i> Manajemen Agen Dukungan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.support.faq') ? 'active' : '' }}" href="{{ route('admin.support.faq') }}">
                                        <i class="fas fa-question-circle"></i> Basis Pengetahuan/FAQ
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.support.reports') ? 'active' : '' }}" href="{{ route('admin.support.reports') }}">
                                        <i class="fas fa-chart-line"></i> Laporan Kinerja Dukungan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Pengaturan Platform -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#settingsAdminCollapse" role="button" aria-expanded="false" aria-controls="settingsAdminCollapse">
                            <i class="fas fa-cogs"></i> Pengaturan Platform
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.settings.*') ? 'show' : '' }}" id="settingsAdminCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}" href="{{ route('admin.settings.general') }}">
                                        <i class="fas fa-sliders-h"></i> Pengaturan Umum
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.payment') ? 'active' : '' }}" href="{{ route('admin.settings.payment') }}">
                                        <i class="fas fa-credit-card"></i> Pengaturan Pembayaran
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.email') ? 'active' : '' }}" href="{{ route('admin.settings.email') }}">
                                        <i class="fas fa-envelope"></i> Pengaturan Email & Notifikasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.security') ? 'active' : '' }}" href="{{ route('admin.settings.security') }}">
                                        <i class="fas fa-shield-alt"></i> Pengaturan Keamanan Platform
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.language') ? 'active' : '' }}" href="{{ route('admin.settings.language') }}">
                                        <i class="fas fa-language"></i> Pengaturan Regional & Bahasa
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.integrations') ? 'active' : '' }}" href="{{ route('admin.settings.integrations') }}">
                                        <i class="fas fa-plug"></i> Integrasi Pihak Ketiga
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.maintenance') ? 'active' : '' }}" href="{{ route('admin.settings.maintenance') }}">
                                        <i class="fas fa-tools"></i> Mode Pemeliharaan Situs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.settings.backup') ? 'active' : '' }}" href="{{ route('admin.settings.backup') }}">
                                        <i class="fas fa-database"></i> Pencadangan & Pemulihan Data
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Laporan & Analitik -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#reportsCollapse" role="button" aria-expanded="false" aria-controls="reportsCollapse">
                            <i class="fas fa-chart-pie"></i> Laporan & Analitik
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.reports.*') ? 'show' : '' }}" id="reportsCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.reports.users') ? 'active' : '' }}" href="{{ route('admin.reports.users') }}">
                                        <i class="fas fa-users"></i> Laporan Pengguna
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.reports.traffic') ? 'active' : '' }}" href="{{ route('admin.reports.traffic') }}">
                                        <i class="fas fa-chart-line"></i> Laporan Lalu Lintas Situs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.reports.conversion') ? 'active' : '' }}" href="{{ route('admin.reports.conversion') }}">
                                        <i class="fas fa-funnel-dollar"></i> Laporan Konversi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.reports.products') ? 'active' : '' }}" href="{{ route('admin.reports.products') }}">
                                        <i class="fas fa-box"></i> Laporan Kinerja Produk
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.reports.custom') ? 'active' : '' }}" href="{{ route('admin.reports.custom') }}">
                                        <i class="fas fa-file-alt"></i> Laporan Kustom
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Alat Bantu Admin -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.tools.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#toolsCollapse" role="button" aria-expanded="false" aria-controls="toolsCollapse">
                            <i class="fas fa-tools"></i> Alat Bantu Admin
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.tools.*') ? 'show' : '' }}" id="toolsCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.tools.cache') ? 'active' : '' }}" href="{{ route('admin.tools.cache') }}">
                                        <i class="fas fa-broom"></i> Pembersihan Cache
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.tools.system') ? 'active' : '' }}" href="{{ route('admin.tools.system') }}">
                                        <i class="fas fa-server"></i> Informasi Sistem & Kesehatan Server
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.tools.logs') ? 'active' : '' }}" href="{{ route('admin.tools.logs') }}">
                                        <i class="fas fa-exclamation-triangle"></i> Log Kesalahan Aplikasi
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">
                            <i class="fas fa-user-cog"></i> Profil Admin Saya
                        </a>
                    </li>
                    
                    <li class="nav-item mt-3">
                        <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">@yield('title')</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    @yield('actions')
                </div>
            </div>
            
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @yield('admin-content')
        </main>
    </div>
</div>
@endsection
