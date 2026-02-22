<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    /**
     * Tampilkan riwayat pesanan user
     */
    public function history()
    {
        $orders = Orders::with('items')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.orderhistory', compact('orders'));
    }

    /**
     * Tampilkan detail pesanan
     */
    public function detail($id)
    {
        $order = Orders::with('items')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        return view('user.orderdetail', compact('order'));
    }
}
