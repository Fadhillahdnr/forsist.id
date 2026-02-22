@extends('admin.layouts.master')

@section('title','Admin Dashboard')

@section('content')

<div class="container my-4">

    {{-- HEADER --}}
    <div class="admin-header mb-5">
        <h2 class="fw-bold mb-1">Admin Control Panel</h2>
        <p class="text-muted">
            Monitoring sistem, statistik real-time & kontrol aplikasi
        </p>
    </div>

    {{-- STATISTICS --}}
    <div class="row g-4 mb-5">

        <div class="col-xl-3 col-md-6">
            <div class="card stat-glass bg-gradient-primary stat-hover">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="stat-label">Total Produk</span>
                            <h2 class="stat-value">{{ $totalProducts }}</h2>
                        </div>
                        <i class="bi bi-box-seam stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-glass bg-gradient-success stat-hover">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="stat-label">Total Klik</span>
                            <h2 class="stat-value" id="total-clicks">
                                {{ number_format($totalClicks) }}
                            </h2>
                        </div>
                        <i class="bi bi-cursor-fill stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-glass bg-gradient-warning stat-hover">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="stat-label">Kategori</span>
                            <h2 class="stat-value">{{ $totalCategories }}</h2>
                        </div>
                        <i class="bi bi-tags-fill stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-glass bg-gradient-dark stat-hover">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="stat-label">Pesanan</span>
                            <h2 class="stat-value" id="total-orders">
                                {{ $totalOrders }}
                            </h2>
                        </div>
                        <i class="bi bi-receipt stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- INSIGHT PANEL --}}
    <div class="row g-4 mb-5">

        <div class="col-md-6">
            <div class="card insight-card">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-graph-up me-2"></i> Insight Sistem
                    </h6>
                    <ul class="insight-list">
                        <li>Total klik produk meningkat hari ini</li>
                        <li>Produk paling sering dilihat tersedia</li>
                        <li>Pesanan baru masuk real-time</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card insight-card">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-lightning-fill me-2"></i> Aksi Cepat
                    </h6>
                    <div class="d-grid gap-2">
                        <a href="{{ route('user.dashboard') }}" target="_blank"
                           class="btn btn-outline-primary">
                            Preview Dashboard User
                        </a>
                        <a href="{{ url('/admin/products') }}"
                           class="btn btn-outline-success">
                            Kelola Produk
                        </a>
                        <a href="{{ route('admin.orders') }}"
                           class="btn btn-outline-warning">
                            Kelola Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CHART SECTION --}}
    <div class="row g-4 mb-5">

        <div class="col-md-6">
            <div class="card insight-card h-100">
                <div class="card-body d-flex flex-column">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-cash-stack me-2"></i> Grafik Pendapatan
                    </h6>

                    <div class="chart-wrapper">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card insight-card h-100">
                <div class="card-body d-flex flex-clumn">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-graph-up-arrow me-2"></i> Grafik Klik Produk
                    </h6>
                    <div class="chart-wrapper">
                        <canvas id="clickChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* ================= GLOBAL STYLE ================= */
const primaryColor = '#6366f1';
const successColor = '#22c55e';
const gridColor = 'rgba(148,163,184,.15)';
const fontFamily = "'Inter', sans-serif";

/* ================= FORMAT RUPIAH ================= */
const formatRupiah = (value) => {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
};

/* ================= REVENUE CHART ================= */
const revenueChart = new Chart(
    document.getElementById('salesChart'),
    {
        type: 'line',
        data: {
            labels: @json($revenueLabels), // tanggal / bulan
            datasets: [{
                label: 'Pendapatan',
                data: @json($revenueData), // SUM(total)
                borderColor: primaryColor,
                backgroundColor: 'rgba(99,102,241,.25)',
                fill: true,
                tension: 0.45,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: primaryColor
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1400,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (context) => formatRupiah(context.raw)
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: gridColor },
                    ticks: { font: { family: fontFamily }}
                },
                y: {
                    grid: { color: gridColor },
                    ticks: {
                        callback: (value) => formatRupiah(value),
                        font: { family: fontFamily }
                    }
                }
            }
        }
    }
);

/* ================= CLICK PRODUCT CHART ================= */
const clickChart = new Chart(
    document.getElementById('clickChart'),
    {
        type: 'bar',
        data: {
            labels: @json($clickLabels), // nama produk
            datasets: [{
                label: 'Klik Produk',
                data: @json($clickData),
                backgroundColor: successColor,
                borderRadius: 8,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1200,
                easing: 'easeOutBounce'
            },
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: fontFamily }}
                },
                y: {
                    grid: { color: gridColor },
                    ticks: {
                        precision: 0,
                        font: { family: fontFamily }
                    }
                }
            }
        }
    }
);

/* ================= REALTIME CLICK ================= */
window.Echo.channel('admin-dashboard')
.listen('.product.viewed', (data) => {
    clickChart.data.labels = data.labels;
    clickChart.data.datasets[0].data = data.values;
    clickChart.update('active');
});

/* ================= REALTIME REVENUE ================= */
window.Echo.channel('admin-dashboard')
.listen('.order.created', (data) => {
    revenueChart.data.labels = data.labels;
    revenueChart.data.datasets[0].data = data.values;
    revenueChart.update('active');
});
</script>

@endsection
@endsection