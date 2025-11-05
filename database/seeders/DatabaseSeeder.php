<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run the ProductSeeder to populate the menu
        $this->call(ProductSeeder::class);

        // You would add other seeders here later (e.g., UserSeeder)
    }
}
