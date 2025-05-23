@extends('layouts.app')

@section('content')
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="SinyalTrading Logo" onerror="this.src='https://via.placeholder.com/150x40?text=SinyalTrading'">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Produk Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Produk
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <!-- Sinyal Trading Submenu -->
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Sinyal Trading</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('signals.index') }}">Lihat Semua Sinyal</a></li>
                                    <li><a class="dropdown-item" href="{{ route('signals.category', 'kripto') }}">Sinyal Kripto</a></li>
                                    <li><a class="dropdown-item" href="{{ route('signals.category', 'forex') }}">Sinyal Forex</a></li>
                                    <li><a class="dropdown-item" href="{{ route('signals.category', 'saham') }}">Sinyal Saham</a></li>
                                </ul>
                            </li>
                            <!-- Bot Trading Submenu -->
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Bot Trading</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('bots.index') }}">Lihat Semua Bot</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bots.category', 'grid') }}">Bot Grid</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bots.category', 'dca') }}">Bot DCA</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bots.category', 'arbitrase') }}">Bot Arbitrase</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Solusi Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Solusi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <li><a class="dropdown-item" href="{{ route('solutions.beginners') }}">Untuk Trader Pemula</a></li>
                            <li><a class="dropdown-item" href="{{ route('solutions.professionals') }}">Untuk Trader Profesional</a></li>
                            <li><a class="dropdown-item" href="{{ route('solutions.crypto-payment') }}">Pembayaran Kripto Aman</a></li>
                            <li><a class="dropdown-item" href="{{ route('solutions.security') }}">Keamanan Platform</a></li>
                            <li><a class="dropdown-item" href="{{ route('solutions.referral') }}">Program Referral</a></li>
                        </ul>
                    </li>
                    
                    <!-- Harga -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pricing') }}">Harga</a>
                    </li>
                    
                    <!-- Wawasan Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Wawasan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                            <li><a class="dropdown-item" href="{{ route('blog.index') }}">Blog</a></li>
                            <li><a class="dropdown-item" href="{{ route('news.index') }}">Berita & Pembaruan Platform</a></li>
                        </ul>
                    </li>
                    
                    <!-- Dukungan Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dukungan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
                            <li><a class="dropdown-item" href="{{ route('support.faq') }}">Pusat Bantuan (FAQ)</a></li>
                            <li><a class="dropdown-item" href="{{ route('support.contact') }}">Hubungi Tim Sales/Dukungan</a></li>
                        </ul>
                    </li>
                </ul>
                
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Language Selector -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown5" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown5">
                            <li><a class="dropdown-item" href="{{ route('language', 'id') }}">Indonesia</a></li>
                            <li><a class="dropdown-item" href="{{ route('language', 'en') }}">English</a></li>
                        </ul>
                    </li>
                    
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('register') }}">Daftar Gratis</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    Profil Saya
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Keluar
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('main-content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- About Platform -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Tentang Platform</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('why-us') }}">Mengapa Memilih Kami?</a></li>
                        <li class="mb-2"><a href="{{ route('careers') }}">Karir</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Products & Services -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Produk & Layanan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('signals.index') }}">Sinyal Trading</a></li>
                        <li class="mb-2"><a href="{{ route('bots.index') }}">Bot Trading</a></li>
                        <li class="mb-2"><a href="{{ route('pricing') }}">Harga & Paket</a></li>
                        <li class="mb-2"><a href="{{ route('referral') }}">Program Referral</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Sumber Daya</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('blog.index') }}">Blog & Artikel</a></li>
                        <li class="mb-2"><a href="{{ route('news.index') }}">Berita & Pembaruan</a></li>
                        <li class="mb-2"><a href="{{ route('guides') }}">Panduan Pengguna</a></li>
                        <li class="mb-2"><a href="{{ route('support.faq') }}">Pusat Bantuan (FAQ)</a></li>
                        <li class="mb-2"><a href="{{ route('tutorials') }}">Tutorial Video</a></li>
                    </ul>
                </div>

                <!-- Legal & Compliance -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Legal & Kepatuhan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('terms') }}">Ketentuan Layanan</a></li>
                        <li class="mb-2"><a href="{{ route('privacy') }}">Kebijakan Privasi</a></li>
                        <li class="mb-2"><a href="{{ route('disclaimer') }}">Disclaimer Risiko Trading</a></li>
                        <li class="mb-2"><a href="{{ route('cookies') }}">Kebijakan Cookie</a></li>
                        <li class="mb-2"><a href="{{ route('refund') }}">Kebijakan Pengembalian Dana</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-4">

            <div class="row align-items-center">
                <!-- Copyright -->
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">&copy; {{ date('Y') }} SinyalTrading. Semua Hak Dilindungi.</p>
                </div>

                <!-- Social Media -->
                <div class="col-md-6 text-center text-md-end">
                    <div class="social-icons">
                        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-telegram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('scripts')
<script>
    // Multi-level dropdown menu
    document.addEventListener('DOMContentLoaded', function() {
        $('.dropdown-submenu > a').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).next('.dropdown-menu').toggle();
        });
    });
</script>
@endsection
