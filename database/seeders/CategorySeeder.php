<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Starters',  'description' => 'Light bites to begin your journey'],
            ['name' => 'Mains',     'description' => 'Our signature main courses'],
            ['name' => 'Desserts',  'description' => 'Sweet endings to a perfect meal'],
            ['name' => 'Drinks',    'description' => 'Refreshing beverages & cocktails'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name'        => $category['name'],
                'slug'        => Str::slug($category['name']), // "Starters" → "starters"
                'description' => $category['description'],
                'order'       => 0,
            ]);
        }
    }
}