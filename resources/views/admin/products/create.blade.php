@extends('admin.layouts.master')

@section('title','Tambah Produk')

@section('content')

<div class="container py-4">

    {{-- CARD UTAMA --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="fw-semibold mb-0">Tambah Produk</h5>
                    <small class="text-muted">Masukkan data produk baru</small>
                </div>

                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali</a>
            </div>

            {{-- KATEGORI PRODUK --}}
            <div class="border rounded p-3 mb-4 bg-dark text-white">

                {{-- TAMBAH KATEGORI --}}
                <form method="POST"
                    action="{{ route('admin.product-category.store') }}">
                    @csrf

                    <label class="form-label fw-semibold">
                        Tambah Kategori Baru
                    </label>

                    <div class="d-flex gap-2 mb-3">
                        <input type="text"
                            name="name"
                            class="form-control form-control-sm"
                            placeholder="Nama kategori"
                            required>

                        <button class="btn btn-dark btn-sm">
                            + Tambah
                        </button>
                    </div>
                </form>

                {{-- DAFTAR KATEGORI --}}
                @if ($categories->count())
                    <hr>

                    <label class="form-label fw-semibold mb-2">
                        Daftar Kategori
                    </label>

                    <ul class="list-group list-group-sm ">
                        @foreach ($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <span>{{ $category->name }}</span>

                                <div class="d-flex gap-1">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.product-category.edit', $category->id) }}"
                                    class="btn btn-outline-warning btn-sm">
                                        ✏️
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.product-category.destroy', $category->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Yakin hapus kategori ini?')">
                                            🗑
                                        </button>
                                    </form>

                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>

            {{-- FORM PRODUK --}}
            <form method="POST"
                  action="{{ url('/admin/products') }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Produk</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="category_id"
                                class="form-select"
                                required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control"
                                  required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga</label>
                        <input type="number"
                               name="price"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file"
                               name="image"
                               class="form-control"
                               required>
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="mt-4">
                    <button class="btn btn-dark btn-sm">
                        Simpan Produk
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
