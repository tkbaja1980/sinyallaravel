@extends('layouts.dashboard')

@section('title', 'Pembayaran Berhasil')

@section('dashboard-content')
<div class="card">
    <div class="card-body">
        <div class="text-center">
            <div class="mb-4">
                <i class="fas fa-check-circle text-success fa-5x"></i>
            </div>
            <h3>Pembayaran Berhasil!</h3>
            <p class="lead">Terima kasih atas pembayaran Anda. Transaksi telah berhasil diproses.</p>
            
            @if(isset($orderId))
            <div class="alert alert-success w-75 mx-auto my-4">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-2x"></i>
                    </div>
                    <div class="text-start">
                        <h5 class="alert-heading">Detail Transaksi</h5>
                        <p class="mb-0">ID Pesanan: <strong>{{ $orderId }}</strong></p>
                        <p class="mb-0">Waktu Pembayaran: <strong>{{ now()->format('d M Y H:i') }}</strong></p>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('user.finance.index') }}" class="btn btn-primary">Kembali ke Keuangan</a>
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary ms-2">Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
