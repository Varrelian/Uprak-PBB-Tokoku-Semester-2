<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'description' => 'Produk elektronik'
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'description' => 'Produk fashion'
            ],
            [
                'name' => 'Makanan',
                'slug' => 'makanan',
                'description' => 'Produk makanan'
            ]
        ]);
    }
}
