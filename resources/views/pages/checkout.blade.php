@extends('user.layouts.master')

@use('Illuminate\Support\Facades\Auth')

@section('title','Checkout')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Checkout</h2>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Validasi Gagal:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">

        {{-- KIRI: RINGKASAN PESANAN --}}
        <div class="col-md-6">
            <h5>Ringkasan Pesanan</h5>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
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
                                <strong>{{ $item->product->name }}</strong><br>
                                <small class="text-muted">ID: {{ $item->product->id }}</small>
                            </td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-end">Rp {{ number_format($item->product->price) }}</td>
                            <td class="text-end">Rp {{ number_format($subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-dark">
                        <th colspan="3" class="text-end">Total:</th>
                        <th class="text-end">Rp {{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        {{-- KANAN: DATA PEMBELI --}}
        <div class="col-md-6">
            <h5>Data Pembeli</h5>

            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" 
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', Auth::user()->name) }}"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Pengiriman</label>
                    <textarea id="address"
                              name="address"
                              class="form-control @error('address') is-invalid @enderror" 
                              rows="3"
                              required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="tel" 
                           id="phone"
                           name="phone"
                           class="form-control @error('phone') is-invalid @enderror" 
                           value="{{ old('phone') }}"
                           required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>

                    <div class="form-check">
                        <input class="form-check-input"
                               id="cod"
                               type="radio"
                               name="payment_method"
                               value="cod"
                               {{ old('payment_method') == 'cod' ? 'checked' : '' }}
                               required>
                        <label class="form-check-label" for="cod">
                            COD (Bayar di Tempat)
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               id="transfer"
                               type="radio"
                               name="payment_method"
                               value="transfer"
                               {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                        <label class="form-check-label" for="transfer">
                            Transfer Bank
                        </label>
                    </div>

                    @error('payment_method')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Kembali ke Keranjang</a>
                    <button type="submit" class="btn btn-success flex-grow-1">
                        Lanjutkan Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
