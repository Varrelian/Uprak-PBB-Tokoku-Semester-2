<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'category_id' => 1,
                'name' => 'Laptop Asus',
                'slug' => 'laptop-asus',
                'description' => 'Laptop Asus Ryzen 5',
                'price' => 8500000,
                'stock' => 10,
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Mouse Logitech',
                'slug' => 'mouse-logitech',
                'description' => 'Mouse Wireless',
                'price' => 250000,
                'stock' => 20,
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Keyboard Mechanical',
                'slug' => 'keyboard-mechanical',
                'description' => 'RGB Keyboard',
                'price' => 500000,
                'stock' => 15,
                'is_active' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Kaos Polos',
                'slug' => 'kaos-polos',
                'description' => 'Kaos Katun',
                'price' => 75000,
                'stock' => 50,
                'is_active' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Jaket Hoodie',
                'slug' => 'jaket-hoodie',
                'description' => 'Hoodie Premium',
                'price' => 200000,
                'stock' => 25,
                'is_active' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Celana Jeans',
                'slug' => 'celana-jeans',
                'description' => 'Jeans Pria',
                'price' => 180000,
                'stock' => 30,
                'is_active' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Keripik Kentang',
                'slug' => 'keripik-kentang',
                'description' => 'Snack Gurih',
                'price' => 15000,
                'stock' => 100,
                'is_active' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Coklat Batang',
                'slug' => 'coklat-batang',
                'description' => 'Coklat Susu',
                'price' => 12000,
                'stock' => 80,
                'is_active' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Biskuit',
                'slug' => 'biskuit',
                'description' => 'Biskuit Renyah',
                'price' => 10000,
                'stock' => 90,
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Monitor LG',
                'slug' => 'monitor-lg',
                'description' => 'Monitor 24 Inch',
                'price' => 2200000,
                'stock' => 8,
                'is_active' => true
            ]
        ]);
    }
}
