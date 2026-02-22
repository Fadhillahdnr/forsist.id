<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar semua order
     */
    public function index()
    {
        $orders = Orders::with('items', 'user')
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Tampilkan detail order
     */
    public function show($id)
    {
        $order = Orders::with('items', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status order
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu pembayaran,diproses,dikirim,selesai,dibatalkan'
        ]);

        $order = Orders::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        // Log untuk audit trail (optional)
        \Log::info("Order #$id status updated from '$oldStatus' to '{$request->status}' by Admin " . auth()->user()->name);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}
