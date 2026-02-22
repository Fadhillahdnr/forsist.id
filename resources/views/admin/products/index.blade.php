@extends('admin.layouts.master')

@section('title','Produk')

@section('content')
<div class="container my-5 text-dark">

    <div class="card shadow-sm border-0">
        <div class="card-body text-dark">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 style="color: #aeaeae" class="fw-bold mb-1">📦 Daftar Produk</h4>
                    <small class="text-muted">
                        Kelola seluruh produk yang tersedia
                    </small>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ url('/admin/products/create') }}"
                       class="btn btn-dark btn-sm">
                        + Produk
                    </a>

                    <a href="{{ route('admin.dashboard') }}"
                       class="btn btn-outline-secondary btn-sm">
                        ← Kembali
                    </a>
                </div>
            </div>

            {{-- FILTER --}}
            <form method="GET" action="{{ url('/admin/products') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <select name="category"
                                class="form-select form-select-sm"
                                onchange="this.form.submit()">
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
            </form>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-muted text-center">
                            <th width="50">No</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- PRODUK --}}
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/'.$product->image) }}"
                                             width="55"
                                             height="55"
                                             class="rounded border object-fit-cover">

                                        <div>
                                            <div class="fw-semibold">
                                                {{ $product->name }}
                                            </div>
                                            <small class="text-muted">
                                                {{ Str::limit($product->description, 45) }}
                                            </small>
                                        </div>
                                    </div>
                                </td>

                                {{-- KATEGORI --}}
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        {{ $product->category->name ?? '-' }}
                                    </span>
                                </td>

                                {{-- HARGA --}}
                                <td class="fw-semibold">
                                    Rp {{ number_format($product->price) }}
                                </td>

                                {{-- AKSI --}}
                                <td class="text-end ">
                                    <a href="{{ url('/admin/products/'.$product->id.'/edit') }}"
                                       class="btn btn-outline-warning btn-sm">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ url('/admin/products/'.$product->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Yakin hapus produk ini?')">
                                            🗑 Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="text-center text-muted py-5">
                                    📭 Belum ada produk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
