<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // PASTERIES
            ['name' => 'Red Velvet Pastry', 'price' => 4.00, 'category' => 'PASTERIES', 'description' => 'Rich, moist velvet cake swirled into a tender pastry, topped with a creamy cheese frosting.', 'image_path' => '/images/red-velvet.jpg'],
            ['name' => 'Rainbow Sprinkles Pastry', 'price' => 3.50, 'category' => 'PASTERIES', 'description' => 'A burst of fun! Sweet pastry dough loaded with colorful rainbow sprinkles.', 'image_path' => '/images/rainbow-sprinkles.jpg'],

            // PIES
            ['name' => 'Key Lime Pie', 'price' => 28.00, 'category' => 'PIES', 'description' => 'Perfectly tart, smooth key lime filling in a buttery graham cracker crust.', 'image_path' => '/images/key-lime.jpg'],
            ['name' => 'Classic Apple Pie', 'price' => 25.00, 'category' => 'PIES', 'description' => 'Flaky, golden lattice crust filled with cinnamon-spiced local apples.', 'image_path' => '/images/apple-pie.jpg'],

            // BROWNIES
            ['name' => 'Oreo Brownie', 'price' => 4.50, 'category' => 'BROWNIES', 'description' => 'Fudgy, decadent dark chocolate brownie baked with crushed Oreo pieces throughout.', 'image_path' => '/images/oreo-brownie.jpg'],

            // CROISSANT
            ['name' => 'Classic Butter Croissant', 'price' => 3.00, 'category' => 'CROISSANT', 'description' => 'Hand-rolled with European butter, resulting in a light, flaky, and golden crescent.', 'image_path' => '/images/butter-croissant.jpg'],
            ['name' => 'Almond Croissant', 'price' => 4.50, 'category' => 'CROISSANT', 'description' => 'Butter croissant filled and topped with a sweet almond paste and sliced almonds.', 'image_path' => '/images/almond-croissant.jpg'],

            // CAKE
            ['name' => 'Chocolate Delight Cake', 'price' => 6.00, 'category' => 'CAKE', 'description' => 'Triple-layer chocolate cake with a rich, velvety chocolate ganache. Sold by the slice.', 'image_path' => '/images/chocolate-delight.jpg'],
            ['name' => 'Praline Cake', 'price' => 6.50, 'category' => 'CAKE', 'description' => 'Southern-inspired cake featuring pecans and a sweet caramel praline glaze. Sold by the slice.', 'image_path' => '/images/praline-cake.jpg'],

            // MUFFINS
            ['name' => 'Blueberry Muffins (Large)', 'price' => 3.00, 'category' => 'MUFFINS', 'description' => 'Large, tender muffins packed with fresh blueberries and topped with a streusel crumb.', 'image_path' => '/images/blueberry-muffin.jpg'],
        ];

        // Prepare the data for insertion by adding slugs, timestamps, and availability status
        $dataToInsert = collect($products)->map(function ($product) {
            return array_merge($product, [
                'slug' => Str::slug($product['name']),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        })->toArray();

        // Clear existing data and insert the new menu items
        DB::table('products')->truncate(); // Use truncate if you want to wipe the table clean first
        DB::table('products')->insert($dataToInsert);
    }
}

