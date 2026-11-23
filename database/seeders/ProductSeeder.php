<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Pro 14',
                'description' => 'Thin and powerful laptop for coding and productivity.',
                'price' => 14990000,
                'stock' => 12,
            ],
            [
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic mouse with silent click technology.',
                'price' => 299000,
                'stock' => 48,
            ],
            [
                'name' => 'Mechanical Keyboard',
                'description' => 'Compact keyboard with tactile switch feedback.',
                'price' => 699000,
                'stock' => 20,
            ],
            [
                'name' => '4K Monitor',
                'description' => 'Crisp display for design, editing, and office work.',
                'price' => 3499000,
                'stock' => 9,
            ],
            [
                'name' => 'USB-C Hub',
                'description' => 'Multi-port hub for docking and file transfer.',
                'price' => 450000,
                'stock' => 31,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
