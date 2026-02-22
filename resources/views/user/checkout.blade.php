@extends('user.layouts.master')

@use('Illuminate\Support\Facades\Auth')

@section('title','Checkout')

@section('content')
<div class="container my-5">

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold">Checkout</h2>
        <p class="text-muted mb-0">
            Lengkapi data dan konfirmasi pesanan kamu
        </p>
    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <strong>Validasi Gagal</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- LEFT: ORDER SUMMARY --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <h5 class="fw-semibold mb-4">🛒 Ringkasan Pesanan</h5>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp

                                @foreach ($cart->items as $item)
                                    @php
                                        $subtotal = $item->product->price * $item->qty;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $item->product->name }}</div>
                                            <small class="text-muted">ID: {{ $item->product->id }}</small>
                                        </td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-end">
                                            Rp {{ number_format($item->product->price) }}
                                        </td>
                                        <td class="text-end fw-semibold">
                                            Rp {{ number_format($subtotal) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Total --}}
                    <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                        <span class="fs-5 fw-semibold">Total</span>
                        <span class="fs-4 fw-bold text-success">
                            Rp {{ number_format($total) }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        {{-- RIGHT: CUSTOMER DATA --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-semibold mb-4">👤 Data Pembeli</h5>

                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text"
                                   name="name"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   value="{{ old('name', Auth::user()->name) }}"
                                   placeholder="Masukkan nama lengkap"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat Pengiriman</label>
                            <textarea name="address"
                                      rows="3"
                                      class="form-control @error('address') is-invalid @enderror"
                                      placeholder="Alamat lengkap pengiriman"
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel"
                                   name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="08xxxxxxxxxx"
                                   value="{{ old('phone') }}"
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Payment --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Metode Pembayaran</label>

                            <div class="border rounded-3 p-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="payment_method"
                                           id="cod"
                                           value="cod"
                                           {{ old('payment_method') == 'cod' ? 'checked' : '' }}
                                           required>
                                    <label class="form-check-label" for="cod">
                                        COD (Bayar di Tempat)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="payment_method"
                                           id="transfer"
                                           value="transfer"
                                           {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="transfer">
                                        Transfer Bank
                                    </label>
                                </div>
                            </div>

                            @error('payment_method')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Action --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                ← Kembali
                            </a>
                            <button type="submit" class="btn btn-success btn-lg flex-grow-1">
                                Konfirmasi Pesanan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
