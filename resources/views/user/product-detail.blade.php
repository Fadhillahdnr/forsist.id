@extends('user.layouts.master')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <div class="row g-4 align-items-center">

        <!-- PRODUCT IMAGE -->
        <div class="col-md-6">
            <div class="card product-card border-0 shadow-lg">
                <img 
                    src="{{ $product->image }}"
                    alt="{{ $product->name }}"
                    class="img-fluid product-img rounded"
                >
            </div>
        </div>

        <!-- PRODUCT INFO -->
        <div class="col-md-6">
            <div class="card p-4 border-0 shadow-sm">
                
                <!-- Title -->
                <h2 class="fw-bold mb-2">
                    {{ $product->name }}
                </h2>

                <!-- Price -->
                <h4 class="text-success fw-semibold mb-3">
                    Rp {{ number_format($product->price) }}
                </h4>

                <!-- Divider -->
                <hr class="border-slate-700">

                <!-- Description -->
                <p class="text-muted mb-4" style="line-height:1.7">
                    {{ $product->description }}
                </p>

                <!-- ACTION -->
                <div class="d-flex flex-wrap gap-2">
                    <a 
                        href="{{ route('cart.add', ['id' => $product->id]) }}"
                        class="btn btn-success px-4 py-2"
                    >
                        <i class="bi bi-cart-plus me-1"></i>
                        Tambah ke Keranjang
                    </a>

                    <a 
                        href="{{ route('user.dashboard') }}"
                        class="btn btn-outline-secondary px-4 py-2"
                    >
                        ← Kembali
                    </a>
                </div>

            </div>
        </div>

    </div>
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
        iconColor: '#22c55e',
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