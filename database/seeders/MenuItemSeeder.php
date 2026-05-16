<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Category;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        // Find categories by name — no hardcoded IDs!
        $starters = Category::where('name', 'Starters')->first();
        $mains    = Category::where('name', 'Mains')->first();
        $desserts = Category::where('name', 'Desserts')->first();
        $drinks   = Category::where('name', 'Drinks')->first();

        $items = [
            // Starters
            ['category_id' => $starters->id, 'name' => 'Bruschetta',        'description' => 'Toasted bread with tomatoes & basil',        'price' => 6.99],
            ['category_id' => $starters->id, 'name' => 'Calamari Fritti',   'description' => 'Crispy fried squid with lemon aioli',         'price' => 9.99],
            ['category_id' => $starters->id, 'name' => 'Caprese Salad',     'description' => 'Fresh mozzarella, tomato & basil',            'price' => 8.50],

            // Mains
            ['category_id' => $mains->id,    'name' => 'Grilled Salmon',    'description' => 'Atlantic salmon with roasted vegetables',     'price' => 18.99],
            ['category_id' => $mains->id,    'name' => 'Beef Tenderloin',   'description' => 'Prime cut with truffle mashed potatoes',      'price' => 26.99],
            ['category_id' => $mains->id,    'name' => 'Pasta Carbonara',   'description' => 'Creamy pasta with pancetta & parmesan',       'price' => 14.99],
            ['category_id' => $mains->id,    'name' => 'Margherita Pizza',  'description' => 'Classic tomato, mozzarella & fresh basil',    'price' => 13.99],

            // Desserts
            ['category_id' => $desserts->id, 'name' => 'Tiramisu',          'description' => 'Classic Italian coffee dessert',              'price' => 7.99],
            ['category_id' => $desserts->id, 'name' => 'Panna Cotta',       'description' => 'Vanilla cream with berry coulis',             'price' => 6.99],

            // Drinks
            ['category_id' => $drinks->id,   'name' => 'Sparkling Water',   'description' => 'San Pellegrino 500ml',                        'price' => 3.50],
            ['category_id' => $drinks->id,   'name' => 'Aperol Spritz',     'description' => 'Aperol, prosecco & soda',                     'price' => 9.00],
        ];

        foreach ($items as $item) {
            MenuItem::create([
                ...$item,
                'is_available' => true,
            ]);
        }
    }
}