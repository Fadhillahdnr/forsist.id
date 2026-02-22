<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong');
        }

        return view('user.checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,transfer',
        ]);

        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong');
        }

        try {
            // Tentukan status berdasarkan metode pembayaran
            $status = $request->payment_method === 'cod'
                ? 'diproses'
                : 'menunggu pembayaran';

            // Hitung total
            $total = 0;
            foreach ($cart->items as $item) {
                if ($item->product) {
                    $total += $item->product->price * $item->qty;
                }
            }

            // Simpan order
            $order = Orders::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'total' => $total,
                'status' => $status,
            ]);
            event(new \App\Events\OrderCreated($order));

            // Simpan order items dari cart
            foreach ($cart->items as $item) {
                if ($item->product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'qty' => $item->qty,
                        'subtotal' => $item->product->price * $item->qty,
                    ]);
                }
            }

            // Hapus hanya item dari cart, jangan hapus cart-nya (PERSISTENT)
            $cart->items()->delete();

            return redirect()->route('user.dashboard')
                ->with('success', 'Pesanan berhasil dibuat. Pesanan Anda akan segera diproses.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage()]);
        }
    }
}

