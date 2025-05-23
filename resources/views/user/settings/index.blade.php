@extends('layouts.dashboard')

@section('title', 'Pengaturan Akun')

@section('dashboard-content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Menu Pengaturan</h5>
            </div>
            <div class="list-group list-group-flush">
                <a href="#profile" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                    <i class="fas fa-user me-2"></i> Profil
                </a>
                <a href="#security" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-shield-alt me-2"></i> Keamanan
                </a>
                <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-bell me-2"></i> Notifikasi
                </a>
                <a href="#api" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-key me-2"></i> API Keys
                </a>
                <a href="#preferences" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="fas fa-sliders-h me-2"></i> Preferensi
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        <div class="tab-content">
            <!-- Profile Settings -->
            <div class="tab-pane fade show active" id="profile">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Profil</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <img src="https://via.placeholder.com/150" class="rounded-circle img-thumbnail" alt="Profile Picture" style="width: 150px; height: 150px;">
                                    <button type="button" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" value="{{ $user->name ?? 'John Doe' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" value="{{ $user->username ?? 'johndoe' }}">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email ?? 'john.doe@example.com' }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="phone" value="{{ $user->phone ?? '+62812345678' }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" rows="3">{{ $user->bio ?? 'Trader aktif dengan pengalaman 5 tahun di pasar kripto dan forex.' }}</textarea>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="country" class="form-label">Negara</label>
                                    <select class="form-select" id="country">
                                        <option value="ID" {{ ($user->country ?? '') == 'ID' ? 'selected' : '' }}>Indonesia</option>
                                        <option value="SG" {{ ($user->country ?? '') == 'SG' ? 'selected' : '' }}>Singapura</option>
                                        <option value="MY" {{ ($user->country ?? '') == 'MY' ? 'selected' : '' }}>Malaysia</option>
                                        <option value="US" {{ ($user->country ?? '') == 'US' ? 'selected' : '' }}>Amerika Serikat</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="timezone" class="form-label">Zona Waktu</label>
                                    <select class="form-select" id="timezone">
                                        <option value="Asia/Jakarta" {{ ($user->timezone ?? '') == 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta (GMT+7)</option>
                                        <option value="Asia/Singapore" {{ ($user->timezone ?? '') == 'Asia/Singapore' ? 'selected' : '' }}>Asia/Singapore (GMT+8)</option>
                                        <option value="Asia/Kuala_Lumpur" {{ ($user->timezone ?? '') == 'Asia/Kuala_Lumpur' ? 'selected' : '' }}>Asia/Kuala_Lumpur (GMT+8)</option>
                                        <option value="America/New_York" {{ ($user->timezone ?? '') == 'America/New_York' ? 'selected' : '' }}>America/New_York (GMT-5)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Security Settings -->
            <div class="tab-pane fade" id="security">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Ubah Password</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Password Saat Ini</label>
                                <input type="password" class="form-control" id="currentPassword">
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="newPassword">
                                <div class="form-text">Password harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, angka, dan simbol.</div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="confirmPassword">
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Autentikasi Dua Faktor</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="enable2FA" {{ ($user->two_factor_enabled ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="enable2FA">Aktifkan Autentikasi Dua Faktor</label>
                        </div>
                        
                        @if($user->two_factor_enabled ?? false)
                            <div class="alert alert-success">
                                <i class="fas fa-shield-alt me-2"></i> Autentikasi Dua Faktor sudah aktif.
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Metode Autentikasi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="twoFactorMethod" id="twoFactorApp" checked>
                                    <label class="form-check-label" for="twoFactorApp">
                                        Aplikasi Autentikator (Google Authenticator, Authy)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="twoFactorMethod" id="twoFactorSMS">
                                    <label class="form-check-label" for="twoFactorSMS">
                                        SMS
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-danger">Nonaktifkan 2FA</button>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i> Autentikasi Dua Faktor belum aktif. Aktifkan untuk meningkatkan keamanan akun Anda.
                            </div>
                            
                            <div class="text-center my-4">
                                <img src="https://via.placeholder.com/200" alt="QR Code" class="img-thumbnail">
                                <p class="mt-2">Pindai kode QR ini dengan aplikasi autentikator Anda.</p>
                                <div class="input-group mb-3" style="max-width: 300px; margin: 0 auto;">
                                    <input type="text" class="form-control" value="ABCD-EFGH-IJKL-MNOP" readonly>
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <form>
                                <div class="mb-3">
                                    <label for="verificationCode" class="form-label">Kode Verifikasi</label>
                                    <input type="text" class="form-control" id="verificationCode" placeholder="Masukkan kode 6 digit dari aplikasi autentikator">
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary">Aktifkan 2FA</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Sesi Login Aktif</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Perangkat</th>
                                        <th>Lokasi</th>
                                        <th>IP Address</th>
                                        <th>Waktu Login</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <i class="fas fa-laptop me-2"></i> Windows 10 - Chrome
                                        </td>
                                        <td>Jakarta, Indonesia</td>
                                        <td>103.112.xxx.xxx</td>
                                        <td>{{ now()->subHours(1)->format('d M Y H:i') }} (Saat ini)</td>
                                        <td>
                                            <span class="badge bg-success">Sesi Ini</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fas fa-mobile-alt me-2"></i> Android - Chrome
                                        </td>
                                        <td>Jakarta, Indonesia</td>
                                        <td>103.112.xxx.xxx</td>
                                        <td>{{ now()->subDays(2)->format('d M Y H:i') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger">Akhiri</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fas fa-tablet-alt me-2"></i> iPad - Safari
                                        </td>
                                        <td>Bandung, Indonesia</td>
                                        <td>36.85.xxx.xxx</td>
                                        <td>{{ now()->subDays(5)->format('d M Y H:i') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger">Akhiri</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                            <button type="button" class="btn btn-danger">Akhiri Semua Sesi Lain</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Notification Settings -->
            <div class="tab-pane fade" id="notifications">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Pengaturan Notifikasi</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <h6 class="mb-3">Sinyal Trading</h6>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="signalEmail" checked>
                                    <label class="form-check-label" for="signalEmail">Email</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="signalSMS" checked>
                                    <label class="form-check-label" for="signalSMS">SMS</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="signalPush" checked>
                                    <label class="form-check-label" for="signalPush">Notifikasi Push</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="signalTelegram" checked>
                                    <label class="form-check-label" for="signalTelegram">Telegram</label>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h6 class="mb-3">Bot Trading</h6>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="botEmail" checked>
                                    <label class="form-check-label" for="botEmail">Email</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="botSMS">
                                    <label class="form-check-label" for="botSMS">SMS</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="botPush" checked>
                                    <label class="form-check-label" for="botPush">Notifikasi Push</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="botTelegram" checked>
                                    <label class="form-check-label" for="botTelegram">Telegram</label>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h6 class="mb-3">Transaksi & Keuangan</h6>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="transactionEmail" checked>
                                    <label class="form-check-label" for="transactionEmail">Email</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="transactionSMS" checked>
                                    <label class="form-check-label" for="transactionSMS">SMS</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="transactionPush" checked>
                                    <label class="form-check-label" for="transactionPush">Notifikasi Push</label>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h6 class="mb-3">Referral & Komisi</h6>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="referralEmail" checked>
                                    <label class="form-check-label" for="referralEmail">Email</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="referralSMS">
                                    <label class="form-check-label" for="referralSMS">SMS</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="referralPush" checked>
                                    <label class="form-check-label" for="referralPush">Notifikasi Push</label>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h6 class="mb-3">Berita & Promosi</h6>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="newsEmail" checked>
                                    <label class="form-check-label" for="newsEmail">Email</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="newsSMS">
                                    <label class="form-check-label" for="newsSMS">SMS</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="newsPush">
                                    <label class="form-check-label" for="newsPush">Notifikasi Push</label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- API Keys Settings -->
            <div class="tab-pane fade" id="api">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">API Keys</h5>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createApiKeyModal">
                            <i class="fas fa-plus me-1"></i> Buat API Key
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> API keys digunakan untuk mengintegrasikan bot trading dengan exchange atau platform trading Anda.
                        </div>
                        
                        @if(isset($apiKeys) && count($apiKeys) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Exchange</th>
                                            <th>Dibuat Pada</th>
                                            <th>Terakhir Digunakan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($apiKeys as $key)
                                        <tr>
                                            <td>{{ $key->name }}</td>
                                            <td>{{ $key->exchange }}</td>
                                            <td>{{ $key->created_at->format('d M Y') }}</td>
                                            <td>{{ $key->last_used_at ? $key->last_used_at->format('d M Y H:i') : 'Belum digunakan' }}</td>
                                            <td>
                                                @if($key->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-primary">Edit</button>
                                                    <button type="button" class="btn btn-outline-danger">Hapus</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-key fa-3x text-muted mb-3"></i>
                                <h5>Belum ada API key</h5>
                                <p class="text-muted">Buat API key untuk mengintegrasikan bot trading dengan exchange Anda.</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createApiKeyModal">
                                    <i class="fas fa-plus me-1"></i> Buat API Key
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Preferences Settings -->
            <div class="tab-pane fade" id="preferences">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Preferensi Tampilan</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Tema</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="themeLight" checked>
                                        <label class="form-check-label" for="themeLight">
                                            Light
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="themeDark">
                                        <label class="form-check-label" for="themeDark">
                                            Dark
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="themeSystem">
                                        <label class="form-check-label" for="themeSystem">
                                            Ikuti Sistem
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="language" class="form-label">Bahasa</label>
                                <select class="form-select" id="language">
                                    <option value="id" selected>Bahasa Indonesia</option>
                                    <option value="en">English</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="dateFormat" class="form-label">Format Tanggal</label>
                                <select class="form-select" id="dateFormat">
                                    <option value="dd/mm/yyyy" selected>DD/MM/YYYY</option>
                                    <option value="mm/dd/yyyy">MM/DD/YYYY</option>
                                    <option value="yyyy-mm-dd">YYYY-MM-DD</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="currency" class="form-label">Mata Uang Utama</label>
                                <select class="form-select" id="currency">
                                    <option value="USD" selected>USD (US Dollar)</option>
                                    <option value="IDR">IDR (Indonesian Rupiah)</option>
                                    <option value="BTC">BTC (Bitcoin)</option>
                                    <option value="ETH">ETH (Ethereum)</option>
                                </select>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Simpan Preferensi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create API Key Modal -->
<div class="modal fade" id="createApiKeyModal" tabindex="-1" aria-labelledby="createApiKeyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createApiKeyModalLabel">Buat API Key Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="apiKeyName" class="form-label">Nama API Key</label>
                        <input type="text" class="form-control" id="apiKeyName" placeholder="Contoh: Binance Bot">
                    </div>
                    <div class="mb-3">
                        <label for="exchange" class="form-label">Exchange</label>
                        <select class="form-select" id="exchange">
                            <option value="">Pilih Exchange</option>
                            <option value="binance">Binance</option>
                            <option value="kucoin">KuCoin</option>
                            <option value="coinbase">Coinbase Pro</option>
                            <option value="huobi">Huobi</option>
                            <option value="okex">OKEx</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="apiKey" class="form-label">API Key</label>
                        <input type="text" class="form-control" id="apiKey" placeholder="Masukkan API Key dari exchange">
                    </div>
                    <div class="mb-3">
                        <label for="apiSecret" class="form-label">API Secret</label>
                        <input type="password" class="form-control" id="apiSecret" placeholder="Masukkan API Secret dari exchange">
                    </div>
                    <div class="mb-3">
                        <label for="apiPassphrase" class="form-label">API Passphrase (opsional)</label>
                        <input type="password" class="form-control" id="apiPassphrase" placeholder="Diperlukan untuk beberapa exchange seperti KuCoin">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Izin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="readPermission" checked>
                            <label class="form-check-label" for="readPermission">
                                Read (Baca informasi akun dan data pasar)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tradePermission" checked>
                            <label class="form-check-label" for="tradePermission">
                                Trade (Buat dan kelola order)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="withdrawPermission">
                            <label class="form-check-label" for="withdrawPermission">
                                Withdraw (Penarikan dana - tidak direkomendasikan)
                            </label>
                        </div>
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i> Pastikan API key Anda memiliki izin yang tepat. Untuk keamanan, sebaiknya nonaktifkan izin penarikan (withdraw).
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
