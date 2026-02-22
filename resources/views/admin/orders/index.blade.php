@extends('admin.layouts.master')

@section('title','Daftar Pesanan')

@section('content')
<div class="container my-4 text-dark">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 style="color: #aeaeae" class="fw-bold mb-1">
                <i class="bi bi-box-seam me-2 text-primary"></i>Daftar Pesanan
            </h4>
            <small class="text-muted">
                Kelola dan pantau seluruh pesanan pelanggan
            </small>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h6 style="color: black" class="fw-semibold mb-0">
                Total Pesanan
                <span class="badge bg-primary ms-2">
                    {{ $orders->total() }}
                </span>
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="text-center" style="background:#f1f5f9">
                        <tr class="small text-uppercase text-muted">
                            <th>ID</th>
                            <th>Pembeli</th>
                            <th>Email</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                {{-- ID --}}
                                <td class="text-center fw-semibold text-primary">
                                    #{{ $order->id }}
                                </td>

                                {{-- NAME --}}
                                <td class="fw-semibold">
                                    {{ $order->name }}
                                </td>

                                {{-- EMAIL --}}
                                <td>
                                    @if ($order->user)
                                        <small class="text-muted">
                                            {{ $order->user->email }}
                                        </small>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                {{-- TOTAL --}}
                                <td class="fw-bold text-success">
                                    Rp {{ number_format($order->total) }}
                                </td>


                                {{-- PAYMENT --}}
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-primary text-white px-3 py-2">
                                        {{ strtoupper($order->payment_method) }}
                                    </span>
                                </td>

                                {{-- STATUS --}}
                                <td class="text-center">
                                    @php
                                        $statusMap = [
                                            'diproses' => 'warning',
                                            'dikirim' => 'info',
                                            'selesai' => 'success',
                                            'menunggu pembayaran' => 'danger',
                                            'dibatalkan' => 'secondary'
                                        ];
                                        $statusColor = $statusMap[$order->status] ?? 'secondary';
                                    @endphp

                                    <span class="badge rounded-pill bg-{{ $statusColor }} text-white px-3 py-2">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                {{-- DATE --}}
                                <td class="text-center">
                                    <small class="text-secondary fw-medium">
                                        {{ $order->created_at->format('d M Y') }}<br>
                                        {{ $order->created_at->format('H:i') }}
                                    </small>
                                </td>

                                {{-- ACTION --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Belum ada pesanan masuk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if ($orders->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @endif

</div>
@endsection
