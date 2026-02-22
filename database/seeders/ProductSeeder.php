<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kategori (atau buat jika belum ada)
        $parfum = Category::firstOrCreate(
            ['name' => 'Parfum'],
            ['name' => 'Parfum']
        );

        $fashion = Category::firstOrCreate(
            ['name' => 'Fashion'],
            ['name' => 'Fashion']
        );

        // ======================
        // PRODUK PARFUM
        // ======================

        Product::create([
            'category_id' => $parfum->id,
            'name' => 'Kahf Humbling Forest Eau De Toilette 35ml',
            'description' => 'Parfum pria dari Kahf dengan aroma woody dan fresh yang terinspirasi dari hutan tropis. Cocok untuk aktivitas harian dan tahan hingga 6-8 jam.',
            'price' => 89000,
            'image' => 'products/kahf-humbling-forest.jpg'
        ]);

        Product::create([
            'category_id' => $parfum->id,
            'name' => 'Kahf Revered Oud Eau De Toilette 35ml',
            'description' => 'Parfum pria dengan aroma oud yang hangat, maskulin, dan elegan. Cocok untuk acara formal maupun malam hari.',
            'price' => 89000,
            'image' => 'products/kahf-revered-oud.jpg'
        ]);

        Product::create([
            'category_id' => $parfum->id,
            'name' => 'HMNS ORGSM Eau De Parfum 100ml',
            'description' => 'Parfum unisex dengan perpaduan floral dan gourmand yang manis serta sensual. Cocok untuk daily wear maupun special occasion.',
            'price' => 365000,
            'image' => 'products/hmns-orgsm.jpg'
        ]);

        Product::create([
            'category_id' => $parfum->id,
            'name' => 'ERIGO x EDP Midnight Edition 50ml',
            'description' => 'Parfum pria dengan aroma spicy dan woody yang modern dan elegan, cocok untuk gaya urban.',
            'price' => 249000,
            'image' => 'products/erigo-midnight.jpg'
        ]);

        // ======================
        // PRODUK FASHION
        // ======================

        Product::create([
            'category_id' => $fashion->id,
            'name' => 'Erigo T-Shirt Basic Cotton Combed 24s',
            'description' => 'Kaos pria berbahan cotton combed 24s yang lembut dan nyaman digunakan sehari-hari. Tersedia berbagai pilihan warna.',
            'price' => 79900,
            'image' => 'products/erigo-tshirt.jpg'
        ]);

        Product::create([
            'category_id' => $fashion->id,
            'name' => 'Erigo Kemeja Flannel Pria',
            'description' => 'Kemeja flannel pria dengan bahan lembut dan desain kasual. Cocok untuk gaya santai maupun semi formal.',
            'price' => 159000,
            'image' => 'products/erigo-flannel.jpg'
        ]);

        Product::create([
            'category_id' => $fashion->id,
            'name' => 'Uniqlo Men Easy Care Slim Fit Shirt',
            'description' => 'Kemeja formal pria berbahan katun dengan teknologi easy care yang tidak mudah kusut. Cocok untuk kerja dan acara resmi.',
            'price' => 299000,
            'image' => 'products/uniqlo-slimfit.jpg'
        ]);

        Product::create([
            'category_id' => $fashion->id,
            'name' => 'Compass Gazelle Low Sneakers',
            'description' => 'Sepatu sneakers lokal dengan desain klasik dan bahan kanvas premium. Nyaman digunakan untuk aktivitas harian.',
            'price' => 398000,
            'image' => 'products/compass-gazelle.jpg'
        ]);
    }
}