<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Parfum',
            'Elektronik',
            'Fashion',
            'Aksesoris'
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}
