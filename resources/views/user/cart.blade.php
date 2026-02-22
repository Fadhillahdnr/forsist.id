@extends('user.layouts.master')

@section('title','Keranjang')

@section('content')
<div class="container my-5">
    <h3 class="fw-bold mb-4">🛒 Keranjang Belanja</h3>

    {{-- Alert --}}
    @foreach (['success','error'] as $msg)
        @if (session($msg))
            <div class="alert alert-{{ $msg == 'success' ? 'success' : 'danger' }} alert-dismissible fade show">
                {{ session($msg) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endforeach

    @if ($cart && $cart->items->count())
        <div class="row">
            {{-- LIST ITEM --}}
            <div class="col-lg-8">
                @php $grandTotal = 0; @endphp

                @foreach ($cart->items as $item)
                    @php
                        $total = $item->product->price * $item->qty;
                        $grandTotal += $total;
                    @endphp

                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <img src="{{ asset('storage/'.$item->product->image) }}"
                                         class="img-fluid rounded"
                                         style="max-height:80px">
                                </div>

                                <div class="col-md-4">
                                    <h6 class="fw-semibold mb-1">
                                        {{ $item->product->name }}
                                    </h6>
                                    <small class="text-muted">
                                        Rp {{ number_format($item->product->price) }}
                                    </small>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('cart.decrease', $item->id) }}"
                                           class="btn btn-outline-secondary btn-sm">−</a>

                                        <span class="btn btn-light btn-sm disabled">
                                            {{ $item->qty }}
                                        </span>

                                        <a href="{{ route('cart.increase', $item->id) }}"
                                           class="btn btn-outline-secondary btn-sm">+</a>
                                    </div>
                                </div>

                                <div class="col-md-2 text-end fw-semibold">
                                    Rp {{ number_format($total) }}
                                </div>

                                <div class="col-md-1 text-end">
                                    <a href="{{ route('cart.remove', $item->id) }}"
                                       class="btn btn-sm btn-outline-danger">
                                        ✕
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- SUMMARY --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Item</span>
                            <span>{{ $cart->items->sum('qty') }}</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                            <span>Total</span>
                            <span>Rp {{ number_format($grandTotal) }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                           class="btn btn-primary w-100 mb-2">
                            Checkout
                        </a>

                        <a href="{{ route('beranda') }}"
                           class="btn btn-outline-secondary w-100">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- EMPTY STATE --}}
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                 width="120" class="mb-3">

            <h5 class="fw-bold">Keranjang Masih Kosong</h5>
            <p class="text-muted">Yuk mulai belanja produk favoritmu</p>

            <a href="{{ route('beranda') }}" class="btn btn-primary">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection
