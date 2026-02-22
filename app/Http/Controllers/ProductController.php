<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // Upload ke Cloudinary
        if ($request->hasFile('image')) {
            $uploadedFile = Cloudinary::upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'forsist/products',
                    'transformation' => [
                        'width'  => 500,
                        'height' => 500,
                        'crop'   => 'fill'
                    ]
                ]
            );

            $data['image'] = $uploadedFile->getSecurePath();
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {

            // Hapus gambar lama dari Cloudinary
            if ($product->image) {
                $publicId = pathinfo($product->image, PATHINFO_FILENAME);
                Cloudinary::destroy('forsist/products/' . $publicId);
            }

            // Upload gambar baru
            $uploadedFile = Cloudinary::upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'forsist/products',
                    'transformation' => [
                        'width'  => 500,
                        'height' => 500,
                        'crop'   => 'fill'
                    ]
                ]
            );

            $data['image'] = $uploadedFile->getSecurePath();
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar dari Cloudinary
        if ($product->image) {
            $publicId = pathinfo($product->image, PATHINFO_FILENAME);
            Cloudinary::destroy('forsist/products/' . $publicId);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }

    public function show(Product $product)
    {
        $sessionKey = 'viewed_product_' . $product->id;

        if (!session()->has($sessionKey)) {
            $product->increment('views');
            session()->put($sessionKey, true);
        }

        return view('user.product-detail', compact('product'));
    }
}