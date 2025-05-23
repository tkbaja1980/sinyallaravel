@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="SinyalTrading Logo" class="img-fluid mb-3" style="max-width: 150px;" onerror="this.src='https://via.placeholder.com/150x40?text=SinyalTrading'">
                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Beranda Dasbor
                        </a>
                    </li>
                    
                    <!-- Manajemen Produk Saya -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.signals.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#signalsCollapse" role="button" aria-expanded="false" aria-controls="signalsCollapse">
                            <i class="fas fa-chart-line"></i> Sinyal Trading Saya
                        </a>
                        <div class="collapse {{ request()->routeIs('user.signals.*') ? 'show' : '' }}" id="signalsCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.signals.subscriptions') ? 'active' : '' }}" href="{{ route('user.signals.subscriptions') }}">
                                        <i class="fas fa-list"></i> Daftar Langganan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.signals.performance') ? 'active' : '' }}" href="{{ route('user.signals.performance') }}">
                                        <i class="fas fa-chart-bar"></i> Riwayat Performa
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.signals.manage') ? 'active' : '' }}" href="{{ route('user.signals.manage') }}">
                                        <i class="fas fa-cog"></i> Kelola Langganan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.bots.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#botsCollapse" role="button" aria-expanded="false" aria-controls="botsCollapse">
                            <i class="fas fa-robot"></i> Bot Trading Saya
                        </a>
                        <div class="collapse {{ request()->routeIs('user.bots.*') ? 'show' : '' }}" id="botsCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.bots.list') ? 'active' : '' }}" href="{{ route('user.bots.list') }}">
                                        <i class="fas fa-list"></i> Daftar Bot Berlisensi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.bots.download') ? 'active' : '' }}" href="{{ route('user.bots.download') }}">
                                        <i class="fas fa-download"></i> Unduh Bot & Dokumentasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.bots.license') ? 'active' : '' }}" href="{{ route('user.bots.license') }}">
                                        <i class="fas fa-key"></i> Manajemen Kunci Lisensi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.bots.status') ? 'active' : '' }}" href="{{ route('user.bots.status') }}">
                                        <i class="fas fa-check-circle"></i> Status Aktivasi Bot
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.bots.config') ? 'active' : '' }}" href="{{ route('user.bots.config') }}">
                                        <i class="fas fa-sliders-h"></i> Konfigurasi Bot
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.bots.updates') ? 'active' : '' }}" href="{{ route('user.bots.updates') }}">
                                        <i class="fas fa-history"></i> Riwayat Pembaruan Bot
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.bots.manage') ? 'active' : '' }}" href="{{ route('user.bots.manage') }}">
                                        <i class="fas fa-cog"></i> Kelola Lisensi/Langganan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.purchases.history') ? 'active' : '' }}" href="{{ route('user.purchases.history') }}">
                            <i class="fas fa-history"></i> Riwayat Pembelian Produk
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.explore') ? 'active' : '' }}" href="{{ route('products.explore') }}">
                            <i class="fas fa-search"></i> Jelajahi Produk Baru
                        </a>
                    </li>
                    
                    <!-- Keuangan & Penagihan -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.finance.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#financeCollapse" role="button" aria-expanded="false" aria-controls="financeCollapse">
                            <i class="fas fa-wallet"></i> Keuangan & Penagihan
                        </a>
                        <div class="collapse {{ request()->routeIs('user.finance.*') ? 'show' : '' }}" id="financeCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.finance.transactions') ? 'active' : '' }}" href="{{ route('user.finance.transactions') }}">
                                        <i class="fas fa-exchange-alt"></i> Riwayat Transaksi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.finance.invoices') ? 'active' : '' }}" href="{{ route('user.finance.invoices') }}">
                                        <i class="fas fa-file-invoice"></i> Faktur Saya
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.finance.subscriptions') ? 'active' : '' }}" href="{{ route('user.finance.subscriptions') }}">
                                        <i class="fas fa-sync"></i> Langganan Aktif & Perpanjangan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.finance.crypto') ? 'active' : '' }}" href="{{ route('user.finance.crypto') }}">
                                        <i class="fab fa-bitcoin"></i> Metode Pembayaran Kripto
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.finance.balance') ? 'active' : '' }}" href="{{ route('user.finance.balance') }}">
                                        <i class="fas fa-coins"></i> Saldo Akun/Kredit
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Program Referral -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.referral.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#referralCollapse" role="button" aria-expanded="false" aria-controls="referralCollapse">
                            <i class="fas fa-users"></i> Program Referral
                        </a>
                        <div class="collapse {{ request()->routeIs('user.referral.*') ? 'show' : '' }}" id="referralCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.referral.dashboard') ? 'active' : '' }}" href="{{ route('user.referral.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i> Dasbor Referral
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.referral.commissions') ? 'active' : '' }}" href="{{ route('user.referral.commissions') }}">
                                        <i class="fas fa-money-bill-wave"></i> Komisi Saya
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.referral.settings') ? 'active' : '' }}" href="{{ route('user.referral.settings') }}">
                                        <i class="fas fa-cog"></i> Pengaturan Pembayaran Komisi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.referral.materials') ? 'active' : '' }}" href="{{ route('user.referral.materials') }}">
                                        <i class="fas fa-ad"></i> Materi Promosi Referral
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Pusat Dukungan & Bantuan -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.support.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#supportCollapse" role="button" aria-expanded="false" aria-controls="supportCollapse">
                            <i class="fas fa-headset"></i> Pusat Dukungan & Bantuan
                        </a>
                        <div class="collapse {{ request()->routeIs('user.support.*') ? 'show' : '' }}" id="supportCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.support.ticket.create') ? 'active' : '' }}" href="{{ route('user.support.ticket.create') }}">
                                        <i class="fas fa-plus-circle"></i> Buat Tiket Dukungan Baru
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.support.tickets') ? 'active' : '' }}" href="{{ route('user.support.tickets') }}">
                                        <i class="fas fa-ticket-alt"></i> Tiket Dukungan Saya
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.support.faq') ? 'active' : '' }}" href="{{ route('user.support.faq') }}">
                                        <i class="fas fa-question-circle"></i> Pusat Bantuan (FAQ)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.support.guides') ? 'active' : '' }}" href="{{ route('user.support.guides') }}">
                                        <i class="fas fa-book"></i> Panduan Pengguna & Tutorial
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Pengaturan Akun & Profil -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.settings.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#settingsCollapse" role="button" aria-expanded="false" aria-controls="settingsCollapse">
                            <i class="fas fa-cog"></i> Pengaturan Akun & Profil
                        </a>
                        <div class="collapse {{ request()->routeIs('user.settings.*') ? 'show' : '' }}" id="settingsCollapse">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.settings.profile') ? 'active' : '' }}" href="{{ route('user.settings.profile') }}">
                                        <i class="fas fa-user"></i> Profil Saya
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.settings.security') ? 'active' : '' }}" href="{{ route('user.settings.security') }}">
                                        <i class="fas fa-shield-alt"></i> Keamanan Akun
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.settings.notifications') ? 'active' : '' }}" href="{{ route('user.settings.notifications') }}">
                                        <i class="fas fa-bell"></i> Preferensi Notifikasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.settings.api') ? 'active' : '' }}" href="{{ route('user.settings.api') }}">
                                        <i class="fas fa-key"></i> Manajemen Kunci API
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.settings.language') ? 'active' : '' }}" href="{{ route('user.settings.language') }}">
                                        <i class="fas fa-language"></i> Preferensi Bahasa & Regional
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.settings.privacy') ? 'active' : '' }}" href="{{ route('user.settings.privacy') }}">
                                        <i class="fas fa-user-secret"></i> Privasi & Data
                                    </a>
                                </li>
                            </ul>
                        </div>
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
            
            @yield('dashboard-content')
        </main>
    </div>
</div>
@endsection
