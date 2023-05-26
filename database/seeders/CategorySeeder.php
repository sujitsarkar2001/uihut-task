<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Home & Kitchen',
            'Beauty & Personal Car',
            'Clothing',
            'Shoes & Jewelry',
            'Toys & games',
            'Health',
            'Household & Baby',
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}
