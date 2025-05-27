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
            UserAccountSeeder::class,
            CriteriaSeeder::class,
            FoodSeeder::class,
            AlternativeFishSeeder::class,
            MasterAlternativesSeeder::class,
        ]);
    }
}
