<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criteria')->insert([
            ['CRITERIA_ID' => 'CRT00001', 'NAME' => 'Harga', 'TYPE' => 'COST'],
            ['CRITERIA_ID' => 'CRT00002', 'NAME' => 'Kompleksitas Pemeliharaan', 'TYPE' => 'COST'],
            ['CRITERIA_ID' => 'CRT00003', 'NAME' => 'Biaya Pemeliharaan', 'TYPE' => 'COST'],
            ['CRITERIA_ID' => 'CRT00004', 'NAME' => 'Ukuran', 'TYPE' => 'COST'],
            ['CRITERIA_ID' => 'CRT00005', 'NAME' => 'Kelangkaan', 'TYPE' => 'BENEFIT'],
            ['CRITERIA_ID' => 'CRT00006', 'NAME' => 'Estetika', 'TYPE' => 'BENEFIT'],
            ['CRITERIA_ID' => 'CRT00007', 'NAME' => 'Perilaku', 'TYPE' => 'BENEFIT'],
        ]);
    }
}
