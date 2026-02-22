@php
    use Illuminate\Support\Str;
@endphp

@extends('user.layouts.master')

@section('title','Beranda')

@section('content')

{{-- ================= ADMIN PREVIEW MODE ================= --}}
@if(auth()->check() && auth()->user()->role === 'admin')
<div class="alert alert-warning d-flex align-items-center justify-content-center gap-2 shadow-sm mb-4">
    <i class="bi bi-eye-fill fs-5"></i>
    <span>
        Anda sedang melihat <strong>Dashboard User (Preview Mode)</strong>
    </span>
</div>
@endif

{{-- ================= HERO SECTION ================= --}}
<div class="text-center my-5">
    <h1 class="fw-bold display-6">Selamat Datang di Toko Kami</h1>
    <p class="text-muted fs-5">
        Temukan produk terbaik dengan kualitas terpercaya
    </p>
</div>

{{-- ================= FILTER CATEGORY ================= --}}
<form method="GET" action="{{ route('user.dashboard') }}" class="mb-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white">
                    <i class="bi bi-tags"></i>
                </span>
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>

{{-- ================= PRODUCT GRID ================= --}}
<div class="row g-4">
@foreach ($products as $product)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
        <div class="product-card-premium">

            {{-- IMAGE --}}
            <div class="product-image-wrapper">
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="product-img"
                     alt="{{ $product->name }}">

                <span class="badge badge-category">
                    {{ $product->category->name }}
                </span>

                <span class="badge badge-views">
                    <i class="bi bi-eye"></i>
                    {{ number_format($product->views ?? 0) }}
                </span>
            </div>

            {{-- BODY --}}
            <div class="product-body">
                <h6 class="product-title">
                    {{ $product->name }}
                </h6>

                <p class="product-desc">
                    {{ Str::limit($product->description, 80) }}
                </p>

                <div class="product-footer">
                    <div class="product-price">
                        Rp {{ number_format($product->price) }}
                    </div>

                    <div class="product-actions">
                        <a href="{{ route('product.show', $product->id) }}"
                           class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('cart.add', $product->id) }}"
                           class="btn btn-primary btn-sm">
                            <i class="bi bi-cart-plus"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endforeach
</div>

{{-- ================= PAGINATION ================= --}}
<div class="d-flex justify-content-center mt-5">
    {{ $products->links() }}
</div>

{{-- ================= MODERN SUCCESS POPUP ================= --}}
@if (session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        background: '#1e293b',
        color: '#fff',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: 'success',
        title: '{{ session('success') }}'
    });
</script>
@endif

@endsection