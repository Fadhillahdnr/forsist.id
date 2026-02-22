@extends('layouts.master')

@section('content')
<div class="container my-5">

    {{-- HERO SECTION --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tentang Kami</h1>
        <p class="text-muted mt-2">
            Mengenal lebih dekat siapa kami dan apa yang kami lakukan
        </p>
    </div>

    {{-- ABOUT CONTENT --}}
    <div class="row align-items-center mb-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <img 
                src="https://images.unsplash.com/photo-1528715471579-d1bcf0ba5e83"
                class="img-fluid rounded shadow"
                alt="About Image"
            >
        </div>
        <div class="col-md-6">
            <h3 class="fw-semibold">Kami Hadir untuk Memberikan yang Terbaik</h3>
            <p class="text-muted mt-3">
                Kami adalah platform UMKM yang menyediakan produk berkualitas dengan harga terjangkau.
                Fokus kami adalah memberikan pengalaman belanja yang mudah, aman, dan nyaman bagi pelanggan.
            </p>
            <p class="text-muted">
                Dengan dukungan teknologi dan tim yang profesional, kami terus berinovasi untuk
                menghadirkan layanan terbaik bagi pelanggan di seluruh Indonesia.
            </p>
        </div>
    </div>

    {{-- VISION & MISSION --}}
    <div class="row text-center mb-5">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="fw-bold">Visi</h4>
                    <p class="text-muted mt-3">
                        Menjadi platform UMKM terpercaya yang mampu bersaing secara nasional dan digital.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="fw-bold">Misi</h4>
                    <p class="text-muted mt-3">
                        Memberdayakan UMKM lokal melalui teknologi, inovasi, dan pelayanan terbaik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- VALUES --}}
    <div class="text-center mb-4">
        <h3 class="fw-bold">Nilai Kami</h3>
        <p class="text-muted">Prinsip yang selalu kami pegang</p>
    </div>

    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold">Kualitas</h5>
                    <p class="text-muted mt-2">
                        Produk terbaik dengan standar kualitas tinggi.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold">Kepercayaan</h5>
                    <p class="text-muted mt-2">
                        Transparansi dan kejujuran kepada pelanggan.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold">Inovasi</h5>
                    <p class="text-muted mt-2">
                        Terus berkembang mengikuti kebutuhan zaman.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
