<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterAlternativesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_alternatives')->delete();

        // Urutan Benefit yang akan di-assign: Kelangkaan, Estetika, Perilaku
        $benefitAssignments = [
            ['Kl' => 1, 'E' => 2, 'P' => 3],
            ['Kl' => 1, 'E' => 3, 'P' => 2],
            ['Kl' => 2, 'E' => 1, 'P' => 3],
            ['Kl' => 2, 'E' => 3, 'P' => 1],
            ['Kl' => 3, 'E' => 1, 'P' => 2],
            ['Kl' => 3, 'E' => 2, 'P' => 1],
            ['Kl' => 1, 'E' => 2, 'P' => 4],
            ['Kl' => 1, 'E' => 4, 'P' => 2],
            ['Kl' => 2, 'E' => 1, 'P' => 4],
            ['Kl' => 2, 'E' => 4, 'P' => 1],
            ['Kl' => 4, 'E' => 1, 'P' => 2],
            ['Kl' => 4, 'E' => 2, 'P' => 1],
            ['Kl' => 1, 'E' => 3, 'P' => 4],
            ['Kl' => 1, 'E' => 4, 'P' => 3],
            ['Kl' => 3, 'E' => 1, 'P' => 4],
            ['Kl' => 3, 'E' => 4, 'P' => 1],
            ['Kl' => 4, 'E' => 1, 'P' => 3],
            ['Kl' => 4, 'E' => 3, 'P' => 1],
            ['Kl' => 2, 'E' => 3, 'P' => 4],
            ['Kl' => 2, 'E' => 4, 'P' => 3]
        ];

        // Data ikan dengan skor yang sudah disesuaikan dengan aturan distribusi ketat dan upaya logika
        // Urutan Cost: Harga, Kompleksitas, Biaya, Ukuran
        $allFishData = [
            // FISH_ID => [Nama Ikan, H, K, B, U, Kl, E, P (akan diambil dari $benefitAssignments)]
            'fed6cbc1-bce9-4778-a511-ada651bc848d' => ['Ikan Cupang', 2, 3, 4, 1], // U=1 (logis), H=2 (logis). Sisa K=3, B=4 (B=4 terpaksa tinggi).
            'b3730910-8a6a-4a56-8b30-c69d1d398c75' => ['Ikan Guppy', 1, 4, 2, 3], // H=1 (logis), U=3 (terpaksa agak besar). Sisa K=4 (jika memperhitungkan overpopulasi), B=2.
            'dc7e1a15-a1b7-4d0f-8163-adfc343a4f3f' => ['Ikan Molly', 1, 3, 4, 2], // H=1 (logis), U=2 (logis). Sisa K=3, B=4 (B=4 terpaksa tinggi).
            '2ca10b74-ec5e-4eff-9058-47dbcf484c7f' => ['Ikan Neon Tetra', 2, 4, 1, 3], // K=4 (sensitif), H=2. Sisa B=1 (pakan murah), U=3 (terpaksa agak besar).
            '001823ac-4140-4fda-8072-75d0985c3cf4' => ['Ikan Platy', 1, 2, 4, 3], // H=1, K=2 (mudah). Sisa B=4 (terpaksa), U=3 (terpaksa agak besar).
            'bf53c165-4350-4bd4-b3e3-2dd2ccc67979' => ['Ikan Sapu-sapu', 1, 2, 3, 4], // H=1 (murah bibit), U=4 (besar). K=2 (perawatan dasar mudah), B=3 (biaya tank besar). Sangat logis.
            'd90a003a-bf1d-43ea-ade2-b169a69f49db' => ['Ikan Koi', 3, 2, 1, 4], // U=4 (besar), H=3 (mahal). K=2 (kompleksitas kolam), B=1 (B=1 terpaksa murah).
            '367b9705-6ee7-47e7-8ac6-b351eea26f92' => ['Ikan Mas Koki', 2, 4, 1, 3], // K=4 (rawan sakit/perawatan khusus), U=3 (ukuran sedang-besar). H=2, B=1 (B=1 terpaksa).
            'f22cf792-5938-4a35-8e03-8f05c35dc672' => ['Ikan Manfish', 3, 2, 4, 1], // U=1 (terpaksa kecil), H=3 (sedang-mahal). K=2, B=4 (B=4 terpaksa tinggi).
            'a329fe9f-684b-4f08-94d6-1deac127a877' => ['Ikan Rainbow Fish', 2, 1, 4, 3], // K=1 (banyak yg mudah), U=3 (terpaksa sedang-besar). H=2, B=4 (B=4 terpaksa tinggi).
            '5e8bda67-0500-47e9-a68f-3bd50f7238d7' => ['Ikan Oscar', 2, 3, 1, 4], // U=4 (besar), H=2 (bibit murah). K=3 (perawatan tank besar), B=1 (B=1 terpaksa murah, makanan predator mahal).
            '9fc22164-5424-4cf6-82b9-d6bcd2aa35a4' => ['Ikan Discus', 4, 3, 1, 2], // H=4 (mahal), K=3 (sulit). U=2 (ukuran sedang), B=1 (B=1 terpaksa).
            'dc440c9a-caec-4ab3-b37a-319c2ac4b1fc' => ['Ikan Corydoras', 2, 1, 4, 3], // K=1 (mudah), U=3 (terpaksa sedang). H=2, B=4 (B=4 terpaksa tinggi). (Seharusnya U=1).
            '2ea7634a-3c0f-4e1a-8814-f6c4a2754e86' => ['Ikan Black Ghost', 3, 4, 1, 2], // K=4 (kebutuhan khusus), U=2 (sedang). H=3, B=1 (B=1 terpaksa).
            'f7be6d0c-31f0-4d2b-9511-27022a826a84' => ['Ikan Louhan', 4, 2, 3, 3], // H=4 (mahal), U=3 (besar). K=2, B=1 (B=1 terpaksa).
            'b6202190-87df-44d5-9ec1-09f92f0e41aa' => ['Ikan Arwana', 4, 3, 2, 1], // H=4 (mahal), K=3 (perawatan khusus). U=1 (SANGAT TERPAKSA KECIL), B=2.
            'cd9eec41-c24f-42e2-866b-ea4d1cc70f87' => ['Ikan Botia', 2, 1, 4, 3], // K=1 (beberapa mudah), U=3 (beberapa besar). H=2, B=4 (B=4 terpaksa tinggi).
            'fc969dbb-92c5-4f8b-a2c4-d5e3cb13e1bb' => ['Ikan Palmas', 3, 2, 1, 4], // U=4 (bisa besar), H=3. K=2, B=1 (B=1 terpaksa).
            'a8df3466-1a7a-43e3-9e3d-ff9fa1f27c11' => ['Ikan Channa', 3, 1, 2, 4], // K=1 (beberapa mudah), U=4 (banyak yg besar). H=3, B=2.
            'b6e6999e-0063-4608-93cd-9c9420b6c7e5' => ['Ikan Arapaima', 3, 2, 4, 4], // U=4 (besar), H=3 (mahal). K=2 (kompleksitas tinggi), B=1 (B=1 SANGAT TERPAKSA MURAH). Ini memenuhi aturan (1,2,3,4) untuk cost.
        ];

        $criteriaIds = [
            'CRT00001', // Harga
            'CRT00002', // Kompleksitas Pemeliharaan
            'CRT00003', // Biaya Pemeliharaan
            'CRT00004', // Ukuran
            'CRT00005', // Kelangkaan
            'CRT00006', // Estetika
            'CRT00007', // Perilaku
        ];

        $dataToInsert = [];
        $fishKeys = array_keys($allFishData); // Untuk iterasi menggunakan indeks

        for ($f = 0; $f < count($fishKeys); $f++) {
            $fishId = $fishKeys[$f];
            $fishScores = $allFishData[$fishId];
            $benefitSet = $benefitAssignments[$f % count($benefitAssignments)]; // Siklus melalui assignment benefit

            $values = [
                $fishScores[1], // Harga
                $fishScores[2], // Kompleksitas
                $fishScores[3], // Biaya
                $fishScores[4], // Ukuran
                $benefitSet['Kl'], // Kelangkaan
                $benefitSet['E'],  // Estetika
                $benefitSet['P']   // Perilaku
            ];

            for ($i = 0; $i < count($criteriaIds); $i++) {
                $dataToInsert[] = [
                    'MASTER_ALTERNATIVES_ID' => Str::uuid()->toString(),
                    'CRITERIA_ID' => $criteriaIds[$i],
                    'FISH_ID' => $fishId,
                    'VALUE' => $values[$i]
                ];
            }
        }
        DB::table('master_alternatives')->insert($dataToInsert);
    }
}