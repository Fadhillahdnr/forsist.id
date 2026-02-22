<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Get or create user's cart
     */
    private function getOrCreateCart()
    {
        return Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);
    }

    /**
     * Add product to cart
     */
    public function add($id)
    {
        try {
            $product = Product::findOrFail($id);
            $cart = $this->getOrCreateCart();

            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $id)
                ->first();

            if ($item) {
                $item->increment('qty');
                return back()->with('success', 'Jumlah produk ditambahkan');
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $id,
                    'qty' => 1
                ]);
                return back()->with('success', 'Produk ditambahkan ke keranjang');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan produk ke keranjang');
        }
    }

    /**
     * Show user's cart
     */
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        // Jika user belum memiliki cart, buat cart kosong
        if (!$cart) {
            $cart = $this->getOrCreateCart();
        }

        return view("user.cart", compact('cart'));
    }

    /**
     * Increase item quantity
     */
    public function increase($id)
    {
        try {
            $item = CartItem::findOrFail($id);
            // Pastikan item milik user yang login
            if ($item->cart->user_id != Auth::id()) {
                return back()->with('error', 'Tidak diizinkan');
            }
            $item->increment('qty');
            return back()->with('success', 'Jumlah ditambah');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah jumlah');
        }
    }

    /**
     * Decrease item quantity
     */
    public function decrease($id)
    {
        try {
            $item = CartItem::findOrFail($id);
            // Pastikan item milik user yang login
            if ($item->cart->user_id != Auth::id()) {
                return back()->with('error', 'Tidak diizinkan');
            }

            if ($item->qty > 1) {
                $item->decrement('qty');
                return back()->with('success', 'Jumlah dikurangi');
            } else {
                $item->delete();
                return back()->with('success', 'Produk dihapus dari keranjang');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah jumlah');
        }
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        try {
            $item = CartItem::findOrFail($id);
            // Pastikan item milik user yang login
            if ($item->cart->user_id != Auth::id()) {
                return back()->with('error', 'Tidak diizinkan');
            }
            $item->delete();
            return back()->with('success', 'Produk dihapus dari keranjang');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus produk');
        }
    }
}

