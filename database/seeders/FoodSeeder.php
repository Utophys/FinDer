<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food')->insert([
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Cacing',
                'DESCRIPTION' => 'Makanan favorit ikan karnivora seperti ikan cupang dan arwana.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Sayuran cincang',
                'DESCRIPTION' => 'Makanan kaya serat untuk ikan seperti ikan mas koi dan goldfish.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Pelet ikan kecil',
                'DESCRIPTION' => 'Pelet yang cocok untuk ikan kecil seperti guppy dan neon tetra.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Daphnia',
                'DESCRIPTION' => 'Makanan hidup yang kaya protein untuk ikan hias.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Sayuran zucchini',
                'DESCRIPTION' => 'Sayuran yang cocok untuk ikan sapu-sapu dan pleco.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Makanan beku',
                'DESCRIPTION' => 'Makanan sehat untuk ikan discus dan cichlid.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Pelet khusus cichlid',
                'DESCRIPTION' => 'Pelet diformulasikan khusus untuk kebutuhan cichlid.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Makanan hidup kecil',
                'DESCRIPTION' => 'Makanan seperti serangga kecil untuk ikan manfish dan black ghost.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Pelet ikan besar',
                'DESCRIPTION' => 'Pelet untuk ikan besar seperti ikan oscar dan arwana.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Krill',
                'DESCRIPTION' => 'Makanan hidup kaya protein untuk ikan hias yang aktif.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Alga',
                'DESCRIPTION' => 'Makanan alami untuk ikan herbivora seperti pleco.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Larva serangga',
                'DESCRIPTION' => 'Makanan hidup yang disukai ikan betta dan channa.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Serangga kecil',
                'DESCRIPTION' => 'Makanan alami untuk banyak ikan hias karnivora.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Pelet warna-warni',
                'DESCRIPTION' => 'Pelet untuk meningkatkan warna ikan seperti rainbow fish.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Tubifex worms',
                'DESCRIPTION' => 'Cacing hidup yang disukai oleh ikan karnivora.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Artemia (brine shrimp)',
                'DESCRIPTION' => 'Makanan hidup terbaik untuk anak ikan dan ikan kecil.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Pelet untuk ikan komunitas',
                'DESCRIPTION' => 'Pelet lengkap untuk berbagai jenis ikan hias.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Makanan serangga kering',
                'DESCRIPTION' => 'Alternatif makanan kering kaya protein.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Cacing darah',
                'DESCRIPTION' => 'Makanan favorit ikan betta dan beberapa ikan predator.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Sayuran muda',
                'DESCRIPTION' => 'Sayuran segar untuk ikan herbivora.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => Str::uuid()->toString(),
                'NAME' => 'Microworms',
                'DESCRIPTION' => 'Makanan hidup untuk menambah variasi diet ikan kecil.',
                'IMAGE' => '',
                'IS_DELETED' => 0,
            ],
        ]);
    }
}
