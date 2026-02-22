@extends('user.layouts.master')

@section('title','Riwayat Pesanan')

@section('content')
<div class="container my-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">📦 Riwayat Pesanan</h2>
            <p class="text-muted mb-0">
                Daftar semua pesanan yang pernah kamu lakukan
            </p>
        </div>
        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
            ← Kembali
        </a>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Jika ada pesanan --}}
    @if ($orders->count())
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $statusColor = match($order->status) {
                                        'diproses' => 'warning',
                                        'dikirim' => 'info',
                                        'selesai' => 'success',
                                        'menunggu pembayaran' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <tr>
                                    <td>
                                        {{ $order->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="fw-semibold">
                                        Rp {{ number_format($order->total) }}
                                    </td>
                                    <td>
                                        <span class="badge bg-primary rounded-pill px-3">
                                            {{ strtoupper($order->payment_method) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $statusColor }} rounded-pill px-3">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('user.orders.detail', $order->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @else
        {{-- Empty State --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <div class="mb-3" style="font-size: 48px;">🛒</div>
                <h5 class="fw-semibold">Belum ada pesanan</h5>
                <p class="text-muted mb-4">
                    Kamu belum melakukan pemesanan apapun
                </p>
                <a href="{{ route('product') }}" class="btn btn-primary btn-lg">
                    Mulai Belanja
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
