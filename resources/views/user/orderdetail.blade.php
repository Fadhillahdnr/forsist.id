@extends('user.layouts.master')

@section('title','Detail Pesanan')

@section('content')
<div class="container my-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Detail Pesanan</h4>
            <small class="text-muted">Order ID #{{ $order->id }}</small>
        </div>
        <a href="{{ route('user.orders') }}" class="btn btn-outline-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    <div class="row">
        {{-- INFO PENGIRIMAN --}}
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm rounded-lg h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted mb-3">Informasi Pengiriman</h6>

                    <div class="mb-3">
                        <small class="text-muted">Nama Penerima</small>
                        <div class="font-weight-bold">{{ $order->name }}</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Alamat</small>
                        <div>{{ $order->address }}</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">No. Telepon</small>
                        <div>{{ $order->phone }}</div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted d-block">Metode Pembayaran</small>
                            <span class="badge badge-primary px-3 py-2">
                                {{ strtoupper($order->payment_method) }}
                            </span>
                        </div>
                        <div class="text-right">
                            <small class="text-muted d-block">Tanggal</small>
                            <strong>{{ $order->created_at->format('d M Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- STATUS --}}
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm rounded-lg h-100">
                <div class="card-body">
                    <h6 class="text-uppercase text-muted mb-4">Status Pesanan</h6>

                    @php
                        $steps = [
                            'dibuat' => 'Pesanan Dibuat',
                            'diproses' => 'Diproses',
                            'dikirim' => 'Dikirim',
                            'selesai' => 'Selesai',
                        ];

                        $activeStep = match($order->status) {
                            'menunggu pembayaran' => 1,
                            'diproses' => 2,
                            'dikirim' => 3,
                            'selesai' => 4,
                            default => 1
                        };
                    @endphp

                    {{-- STEPPER --}}
                    <div class="stepper">
                        @foreach ($steps as $i => $label)
                            @php $index = $loop->iteration; @endphp
                            <div class="step {{ $index <= $activeStep ? 'active' : '' }}">
                                <div class="circle">{{ $index }}</div>
                                <div class="label">{{ $label }}</div>
                            </div>
                        @endforeach
                    </div>

                    {{-- ALERT PEMBAYARAN --}}
                    @if ($order->status == 'menunggu pembayaran')
                        <div class="alert alert-danger mt-4 mb-0">
                            <strong>Menunggu Pembayaran</strong><br>
                            Silakan lakukan pembayaran sebesar
                            <strong>Rp {{ number_format($order->total) }}</strong>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- PRODUK --}}
    <div class="card border-0 shadow-sm rounded-lg mt-4">
        <div class="card-body">
            <h6 class="text-uppercase text-muted mb-3">Produk Dipesan</h6>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Produk</th>
                            <th class="text-right">Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->product_name }}</strong><br>
                                <small class="text-muted">#{{ $item->product_id }}</small>
                            </td>
                            <td class="text-right">Rp {{ number_format($item->price) }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-right font-weight-bold">
                                Rp {{ number_format($item->subtotal) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <th class="text-right text-primary">
                                Rp {{ number_format($order->total) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- ACTION --}}
    <div class="text-right mt-4">
        <a href="{{ route('beranda') }}" class="btn btn-primary px-4">
            Lanjut Belanja
        </a>
    </div>

</div>

{{-- STYLE --}}
<style>
.stepper {
    display: flex;
    justify-content: space-between;
    position: relative;
}
.stepper::before {
    content: '';
    position: absolute;
    top: 18px;
    left: 0;
    right: 0;
    height: 2px;
    background: #dee2e6;
}
.step {
    text-align: center;
    position: relative;
    z-index: 1;
    width: 100%;
}
.step .circle {
    width: 36px;
    height: 36px;
    margin: auto;
    border-radius: 50%;
    background: #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
.step.active .circle {
    background: #007bff;
    color: #fff;
}
.step .label {
    margin-top: 8px;
    font-size: 13px;
}
</style>
@endsection
