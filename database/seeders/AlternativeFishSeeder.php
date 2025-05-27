<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternativeFishSeeder extends Seeder
{
    /**

     *
     * @return void
     */
    public function run()
    {
        DB::table('alternative_fish')->insert([
            [
                'FISH_ID' => 'fed6cbc1-bce9-4778-a511-ada651bc848d',
                'NAME' => 'Ikan Cupang',
                'DESCRIPTION' => 'Ikan hias populer dengan warna mencolok dan sirip indah.',
                'FOOD_ID' => 'd372cee5-a8da-4510-95d0-70438c16a304', // Larva serangga (cocok untuk Betta)
                'IMAGE' => 'cupang.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'b3730910-8a6a-4a56-8b30-c69d1d398c75',
                'NAME' => 'Ikan Guppy',
                'DESCRIPTION' => 'Ikan kecil berwarna cerah yang mudah dipelihara.',
                'FOOD_ID' => 'e6e995d4-bf76-490f-98c8-a2476aa15149', // Pelet ikan kecil
                'IMAGE' => 'guppy.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f',
                'NAME' => 'Ikan Molly',
                'DESCRIPTION' => 'Ikan damai yang cocok untuk akuarium komunitas.',
                'FOOD_ID' => '67fab212-589b-4bc7-8482-c276d06c1421', // Pelet untuk ikan komunitas
                'IMAGE' => 'molly.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => '2ca10b74-ec5e-4eff-9058-47dbcf484c7f',
                'NAME' => 'Ikan Neon Tetra',
                'DESCRIPTION' => 'Ikan kecil yang indah dan aktif, cocok untuk akuarium.',
                'FOOD_ID' => 'e6e995d4-bf76-490f-98c8-a2476aa15149', // Pelet ikan kecil
                'IMAGE' => 'neon_tetra.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => '001823ac-4140-4fda-8072-75d0985c3cf4',
                'NAME' => 'Ikan Platy',
                'DESCRIPTION' => 'Ikan ramah pemula yang mudah dipelihara.',
                'FOOD_ID' => '67fab212-589b-4bc7-8482-c276d06c1421', // Pelet untuk ikan komunitas
                'IMAGE' => 'platy.jpg', // Asumsi nama file, tidak ada di list update SQL
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'bf53c165-4350-4bd4-b3e3-2dd2ccc67979',
                'NAME' => 'Ikan Sapu-sapu',
                'DESCRIPTION' => 'Ikan pembersih akuarium yang aktif di dasar.',
                'FOOD_ID' => '426767da-412b-4e9e-a41f-7e2963cbb8c2', // Sayuran zucchini (cocok untuk pleco)
                'IMAGE' => 'sapu_sapu.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'd90a003a-bf1d-43ea-ade2-b169a69f49db',
                'NAME' => 'Ikan Koi',
                'DESCRIPTION' => 'Ikan mahal dengan warna indah dan ukuran besar.',
                'FOOD_ID' => '412d773f-a2b0-44c0-9ed7-ca9dadec486c', // Sayuran cincang (cocok untuk koi)
                'IMAGE' => 'koi.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => '367b9705-6ee7-47e7-8ac6-b351eea26f92',
                'NAME' => 'Ikan Mas Koki',
                'DESCRIPTION' => 'Ikan dengan tubuh bulat dan gerakan anggun.',
                'FOOD_ID' => '412d773f-a2b0-44c0-9ed7-ca9dadec486c', // Sayuran cincang (cocok untuk goldfish)
                'IMAGE' => 'mas_koki.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'f22cf792-5938-4a35-8e03-8f05c35dc672',
                'NAME' => 'Ikan Manfish',
                'DESCRIPTION' => 'Ikan elegan dengan sirip panjang dan gerakan tenang.',
                'FOOD_ID' => 'af676823-765c-4575-8c39-998a8d69a7ff', // Makanan hidup kecil (cocok untuk manfish)
                'IMAGE' => 'manfish.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'a329fe9f-684b-4f08-94d6-1deac127a877',
                'NAME' => 'Ikan Rainbow Fish',
                'DESCRIPTION' => 'Ikan kecil berwarna-warni yang aktif bergerak.',
                'FOOD_ID' => '8538c45d-ff02-424b-ac1e-46f896defa29', // Pelet warna-warni (cocok untuk rainbow fish)
                'IMAGE' => 'rainbow_fish.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => '5e8bda67-0500-47e9-a68f-3bd50f7238d7',
                'NAME' => 'Ikan Oscar',
                'DESCRIPTION' => 'Ikan agresif yang membutuhkan ruang cukup besar.',
                'FOOD_ID' => 'd9ed69dc-b7ef-4e2c-984c-6cf9cccf5605', // Pelet ikan besar (cocok untuk oscar)
                'IMAGE' => 'oscar.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4',
                'NAME' => 'Ikan Discus',
                'DESCRIPTION' => 'Ikan eksotis dengan warna dan bentuk tubuh menarik.',
                'FOOD_ID' => '5a845c06-1237-4564-9813-588e247cddd1', // Makanan beku (cocok untuk discus)
                'IMAGE' => 'discus.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc',
                'NAME' => 'Ikan Corydoras',
                'DESCRIPTION' => 'Ikan dasar yang damai dan aktif di malam hari.',
                'FOOD_ID' => '2491bebb-3f19-4706-b63b-c23b3516a2ff', // Microworms (cocok untuk ikan kecil/dasar)
                'IMAGE' => 'corydoras.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86',
                'NAME' => 'Ikan Black Ghost',
                'DESCRIPTION' => 'Ikan misterius dengan warna hitam pekat.',
                'FOOD_ID' => 'af676823-765c-4575-8c39-998a8d69a7ff', // Makanan hidup kecil (cocok untuk black ghost)
                'IMAGE' => 'black_ghost.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'f7be6d0c-31f0-4d2b-9511-27022a826a84',
                'NAME' => 'Ikan Louhan',
                'DESCRIPTION' => 'Ikan eksotis dengan bentuk unik dan warna mencolok.',
                'FOOD_ID' => '998e9258-495b-4d69-b968-ab4cf970e46f', // Pelet khusus cichlid
                'IMAGE' => 'louhan.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'b6202190-87df-44d5-9ec1-09f92f0e41aa',
                'NAME' => 'Ikan Arwana',
                'DESCRIPTION' => 'Ikan predator besar yang eksotis dan langka.',
                'FOOD_ID' => 'd9ed69dc-b7ef-4e2c-984c-6cf9cccf5605', // Pelet ikan besar (cocok untuk arwana)
                'IMAGE' => 'arwana.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'cd9eec41-c24f-42e2-866b-ea4d1cc70f87',
                'NAME' => 'Ikan Botia',
                'DESCRIPTION' => 'Ikan unik dengan pola belang dan aktif di dasar.',
                'FOOD_ID' => 'a06f42a2-1d30-4e64-9aff-289ad936d9fc', // Tubifex worms (disukai ikan dasar karnivora/omnivora)
                'IMAGE' => 'botia.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb',
                'NAME' => 'Ikan Palmas',
                'DESCRIPTION' => 'Ikan mirip naga kecil dengan tubuh panjang.',
                'FOOD_ID' => '6330e20b-30ef-488d-b807-50be8a8e5b5d', // Serangga kecil
                'IMAGE' => 'palmas.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11',
                'NAME' => 'Ikan Channa',
                'DESCRIPTION' => 'Ikan predator semi-agresif yang populer di kalangan hobiis.',
                'FOOD_ID' => 'd372cee5-a8da-4510-95d0-70438c16a304', // Larva serangga (cocok untuk channa)
                'IMAGE' => 'channa.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
            [
                'FISH_ID' => 'b6e6999e-0063-4608-93cd-9c9420b6c7e5',
                'NAME' => 'Ikan Arapaima',
                'DESCRIPTION' => 'Ikan raksasa dari Amazon yang sangat langka.',
                'FOOD_ID' => 'd9ed69dc-b7ef-4e2c-984c-6cf9cccf5605', // Pelet ikan besar
                'IMAGE' => 'arapaima.jpg',
                'IS_VERIFIED' => 1,
                'IS_DELETED' => 0
            ],
        ]);
    }
}