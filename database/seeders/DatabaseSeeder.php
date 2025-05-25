<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Daftarkan semua seeder di sini
        $this->call([
            CriteriaSeeder::class,
            AlternativeFishSeeder::class,
            MasterAlternativesSeeder::class,
            FoodSeeder::class
        ]);
    }
}
