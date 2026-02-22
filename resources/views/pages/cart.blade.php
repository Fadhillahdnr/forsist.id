@extends('layouts.master')

@section('title','Keranjang')

@section('content')
<div class="container my-4">
    <h2>Keranjang Belanja</h2>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($cart && $cart->items->count())
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach ($cart->items as $item)
                    @php
                        $total = $item->product->price * $item->qty;
                        $grandTotal += $total;
                    @endphp

                    <tr>
                        <td>
                            <img src="{{ asset('storage/'.$item->product->image) }}"
                                 width="60" class="me-2">

                            {{ $item->product->name }}
                        </td>

                        <td>Rp {{ number_format($item->product->price) }}</td>

                        <td class="text-center">
                            <a href="{{ route('cart.decrease', $item->id) }}"
                               class="btn btn-sm btn-outline-secondary">−</a>

                            <span class="mx-2">{{ $item->qty }}</span>

                            <a href="{{ route('cart.increase', $item->id) }}"
                               class="btn btn-sm btn-outline-secondary">+</a>
                        </td>

                        <td>Rp {{ number_format($total) }}</td>

                        <td>
                            <a href="{{ route('cart.remove', $item->id) }}"
                               class="btn btn-danger btn-sm">
                                Hapus
                            </a>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <th colspan="3">Total</th>
                    <th colspan="2">Rp {{ number_format($grandTotal) }}</th>
                </tr>
            </tbody>
        </table>

        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('beranda') }}" class="btn btn-secondary">Lanjut Belanja</a>
            <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
        </div>
    @else
        <p class="text-muted">Keranjang Anda masih kosong</p>
        <a href="{{ route('beranda') }}" class="btn btn-primary">Mulai Belanja</a>
    @endif
</div>
@endsection
