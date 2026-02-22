<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Events\ProductViewed;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->latest()
            ->paginate(8);

        return view('user.dashboard', compact('products', 'categories'));
    }

    /**
     * Display product listing page
     */
    public function product(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->latest()
            ->paginate(12);

        return view('user.dashboard', compact('products', 'categories'));
    }
    
    public function show(Product $product)
    {
        $sessionKey = 'viewed_product_' . $product->id;

        if (!session()->has($sessionKey)) {
            $product->increment('views');

            broadcast(new \App\Events\ProductViewed($product))->toOthers();

            session()->put($sessionKey, true);
        }

        return view('user.product-detail', compact('product'));
    }

    public function about(){
        return view('user.about');
    }
    
    public function cart(){
        return view('user.cart');
    }

}
