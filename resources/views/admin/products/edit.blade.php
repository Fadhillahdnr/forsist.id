@extends('admin.layouts.master')

@section('title','Edit Produk')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="fw-semibold mb-0">Edit Produk</h5>
                    <small class="text-muted">Perbarui informasi produk</small>
                </div>

                <a href="{{ url()->previous() }}"
                   class="btn btn-outline-secondary btn-sm">
                    ← Kembali
                </a>
            </div>

            {{-- FORM --}}
            <form method="POST"
                  action="{{ url('/admin/products/'.$product->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <label class="form-label">Kategori</label>
                    <select name="category_id"
                            class="form-select"
                            required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Produk</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $product->name) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga</label>
                        <input type="number"
                               name="price"
                               value="{{ old('price', $product->price) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control"
                                  required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    {{-- GAMBAR --}}
                    <div class="col-md-6">
                        <label class="form-label">Gambar Sekarang</label>
                        <div>
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 width="120"
                                 class="rounded border">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ganti Gambar (opsional)</label>
                        <input type="file"
                               name="image"
                               class="form-control">
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-dark btn-sm">
                        Update Produk
                    </button>

                    <a href="{{ url('/admin/products') }}"
                       class="btn btn-outline-secondary btn-sm">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
