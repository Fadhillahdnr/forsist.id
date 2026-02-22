@extends('admin.layouts.master')

@section('title','Detail Pesanan')

@section('content')
<div class="container-fluid my-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Detail Pesanan</h4>
            <small class="text-muted">Order #{{ $order->id }}</small>
        </div>
        <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">

        {{-- INFO CUSTOMER --}}
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm rounded-lg h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted mb-3">Informasi Pembeli</h6>

                    <div class="mb-3">
                        <small class="text-muted">Nama</small>
                        <div class="fw-bold">{{ $order->name }}</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Email</small>
                        <div>
                            @if ($order->user)
                                <a href="mailto:{{ $order->user->email }}">
                                    {{ $order->user->email }}
                                </a>
                            @else
                                <span class="text-muted">Guest</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">No. Telepon</small>
                        <div>
                            <a href="tel:{{ $order->phone }}">{{ $order->phone }}</a>
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Alamat Pengiriman</small>
                        <div>{{ $order->address }}</div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted d-block">Pembayaran</small>
                            <span class="badge bg-primary px-3 py-2">
                                {{ strtoupper($order->payment_method) }}
                            </span>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">Tanggal</small>
                            <strong>{{ $order->created_at->format('d M Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATUS & ACTION --}}
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm rounded-lg h-100">
                <div class="card-body">

                    <h6 class="text-uppercase text-muted mb-4">Status Pesanan</h6>

                    @php
                        $statusColor = match($order->status) {
                            'menunggu pembayaran' => 'danger',
                            'diproses' => 'warning',
                            'dikirim' => 'info',
                            'selesai' => 'success',
                            'dibatalkan' => 'secondary',
                            default => 'secondary'
                        };
                    @endphp

                    {{-- STATUS BADGE --}}
                    <div class="text-center mb-4">
                        <span class="badge bg-{{ $statusColor }} px-4 py-2 fs-6">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>

                    {{-- UPDATE STATUS --}}
                    <form method="POST" action="{{ route('admin.orders.status', $order->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Update Status Pesanan
                            </label>
                            <select name="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required>
                                <option value="">-- Pilih Status --</option>
                                <option value="menunggu pembayaran" {{ $order->status == 'menunggu pembayaran' ? 'selected' : '' }}>
                                    ⏳ Menunggu Pembayaran
                                </option>
                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>
                                    ⚙️ Diproses
                                </option>
                                <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>
                                    🚚 Dikirim
                                </option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                    ✅ Selesai
                                </option>
                                <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>
                                    ❌ Dibatalkan
                                </option>
                            </select>

                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-success w-100">
                            Update Status
                        </button>
                    </form>

                    <div class="alert alert-light border mt-4 mb-0">
                        <small class="text-muted">
                            Perubahan status akan langsung terlihat oleh pelanggan.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- PRODUK --}}
    <div class="card border-0 shadow-sm rounded-lg mt-4">
        <div class="card-body">
            <h6 class="text-uppercase text-muted mb-3">Detail Produk</h6>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Produk</th>
                            <th class="text-end">Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->product_name }}</strong><br>
                                <small class="text-muted">#{{ $item->product_id }}</small>
                            </td>
                            <td class="text-end">Rp {{ number_format($item->price) }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-end fw-bold">
                                Rp {{ number_format($item->subtotal) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">TOTAL</th>
                            <th class="text-end text-primary">
                                Rp {{ number_format($order->total) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
