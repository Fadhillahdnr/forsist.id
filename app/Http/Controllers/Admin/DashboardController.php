<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Orders;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        /* ================= STAT ================= */
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalOrders     = Orders::count();
        $totalClicks     = Product::sum('views');

        /* ================= PENDAPATAN CHART (7 HARI TERAKHIR) ================= */
        $revenues = Orders::select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('SUM(total) as total_revenue')
                )
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date')
                ->get();


        $revenueLabels = $revenues->pluck('date');
        $revenueData   = $revenues->pluck('total_revenue');

        /* ================= CLICK CHART (TOP 7 PRODUK) ================= */
        $clicks = Product::orderBy('views', 'desc')
            ->limit(7)
            ->get();

        $clickLabels = $clicks->pluck('name');
        $clickData   = $clicks->pluck('views');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalClicks',
            'revenueLabels',
            'revenueData',
            'clickLabels',
            'clickData'
        ));
    }
}
