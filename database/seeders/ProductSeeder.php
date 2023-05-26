<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Besnik',
                'thumbnail' => fake()->imageUrl(),
                'preview_images' => []
            ]
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate([
                'name'           => $product['name'],
                'thumbnail'      => $product['thumbnail'],
                'preview_images' => $product['preview_images']
            ])
            ->categories()
            ->sync([1,2,3]);
        }
    }
}
