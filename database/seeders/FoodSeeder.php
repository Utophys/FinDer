<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'FOOD_ID' => '200ab5f0-4abc-49a1-843c-a81b89e4e611',
                'NAME' => 'Cacing',
                'DESCRIPTION' => 'Makanan favorit ikan karnivora seperti ikan cupang dan arwana.',
                'IMAGE' => 'cacing.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '412d773f-a2b0-44c0-9ed7-ca9dadec486c',
                'NAME' => 'Sayuran cincang',
                'DESCRIPTION' => 'Makanan kaya serat untuk ikan seperti ikan mas koi dan goldfish.',
                'IMAGE' => 'sayuran_cincang.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'e6e995d4-bf76-490f-98c8-a2476aa15149',
                'NAME' => 'Pelet ikan kecil',
                'DESCRIPTION' => 'Pelet yang cocok untuk ikan kecil seperti guppy dan neon tetra.',
                'IMAGE' => 'pelet_ikan_kecil.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'b08dbd38-4858-4864-9da6-ca19eddd3728',
                'NAME' => 'Daphnia',
                'DESCRIPTION' => 'Makanan hidup yang kaya protein untuk ikan hias.',
                'IMAGE' => 'daphnia.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '426767da-412b-4e9e-a41f-7e2963cbb8c2',
                'NAME' => 'Sayuran zucchini',
                'DESCRIPTION' => 'Sayuran yang cocok untuk ikan sapu-sapu dan pleco.',
                'IMAGE' => 'sayuran_zucchini.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '5a845c06-1237-4564-9813-588e247cddd1',
                'NAME' => 'Makanan beku',
                'DESCRIPTION' => 'Makanan sehat untuk ikan discus dan cichlid.',
                'IMAGE' => 'makanan_beku.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '998e9258-495b-4d69-b968-ab4cf970e46f',
                'NAME' => 'Pelet khusus cichlid',
                'DESCRIPTION' => 'Pelet diformulasikan khusus untuk kebutuhan cichlid.',
                'IMAGE' => 'pelet_khusus_cichlid.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'af676823-765c-4575-8c39-998a8d69a7ff',
                'NAME' => 'Makanan hidup kecil',
                'DESCRIPTION' => 'Makanan seperti serangga kecil untuk ikan manfish dan black ghost.',
                'IMAGE' => 'makanan_hidup_kecil.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'd9ed69dc-b7ef-4e2c-984c-6cf9cccf5605',
                'NAME' => 'Pelet ikan besar',
                'DESCRIPTION' => 'Pelet untuk ikan besar seperti ikan oscar dan arwana.',
                'IMAGE' => 'pelet_ikan_besar.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '368d8948-92b7-45d9-816b-8e74d08d4368',
                'NAME' => 'Krill',
                'DESCRIPTION' => 'Makanan hidup kaya protein untuk ikan hias yang aktif.',
                'IMAGE' => 'krill.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'eb1d3457-fabe-4c8c-b35f-82e8797c8af0',
                'NAME' => 'Alga',
                'DESCRIPTION' => 'Makanan alami untuk ikan herbivora seperti pleco.',
                'IMAGE' => 'alga.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'd372cee5-a8da-4510-95d0-70438c16a304',
                'NAME' => 'Larva serangga',
                'DESCRIPTION' => 'Makanan hidup yang disukai ikan betta dan channa.',
                'IMAGE' => 'larva_serangga.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '6330e20b-30ef-488d-b807-50be8a8e5b5d',
                'NAME' => 'Serangga kecil',
                'DESCRIPTION' => 'Makanan alami untuk banyak ikan hias karnivora.',
                'IMAGE' => 'serangga_kecil.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '8538c45d-ff02-424b-ac1e-46f896defa29',
                'NAME' => 'Pelet warna-warni',
                'DESCRIPTION' => 'Pelet untuk meningkatkan warna ikan seperti rainbow fish.',
                'IMAGE' => 'pelet_warna_warni.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'a06f42a2-1d30-4e64-9aff-289ad936d9fc',
                'NAME' => 'Tubifex worms',
                'DESCRIPTION' => 'Cacing hidup yang disukai oleh ikan karnivora.',
                'IMAGE' => 'tubifex_worms.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'f980b966-39bc-4579-a71c-695f14163d30',
                'NAME' => 'Artemia (brine shrimp)',
                'DESCRIPTION' => 'Makanan hidup terbaik untuk anak ikan dan ikan kecil.',
                'IMAGE' => 'artemia.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '67fab212-589b-4bc7-8482-c276d06c1421',
                'NAME' => 'Pelet untuk ikan komunitas',
                'DESCRIPTION' => 'Pelet lengkap untuk berbagai jenis ikan hias.',
                'IMAGE' => 'pelet_ikan_komunitas.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'da43c35e-5c02-40ab-8337-8e125c4def9f',
                'NAME' => 'Makanan serangga kering',
                'DESCRIPTION' => 'Alternatif makanan kering kaya protein.',
                'IMAGE' => 'makanan_serangga_kering.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => 'f819a6d5-9f95-4d4e-86ea-4f4878c68dbd',
                'NAME' => 'Cacing darah',
                'DESCRIPTION' => 'Makanan favorit ikan betta dan beberapa ikan predator.',
                'IMAGE' => 'cacing_darah.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '7eee5796-9877-46bf-b6a5-91d05fb09ca2',
                'NAME' => 'Sayuran muda',
                'DESCRIPTION' => 'Sayuran segar untuk ikan herbivora.',
                'IMAGE' => 'sayuran_muda.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '2491bebb-3f19-4706-b63b-c23b3516a2ff',
                'NAME' => 'Microworms',
                'DESCRIPTION' => 'Makanan hidup untuk menambah variasi diet ikan kecil.',
                'IMAGE' => 'microworms.jpg',
                'IS_DELETED' => 0,
            ],
            [
                'FOOD_ID' => '3c5667fc-a3fe-44f9-a0f8-8ea2aa50898f',
                'NAME' => 'Udang Kering',
                'DESCRIPTION' => 'Makanan tambahan kaya protein, baik untuk variasi.',
                'IMAGE' => 'udang_kering.jpg',
                'IS_DELETED' => 0,
            ],
        ]);
    }
}