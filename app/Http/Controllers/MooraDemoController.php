<?php

namespace App\Http\Controllers;

use App\Models\Variety;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Food;
use App\Models\AlternativeFish;
use App\Models\Criteria;
use App\Models\Results;
use App\Models\ResultDetails;
use App\Models\MasterAlternative;
use App\Models\MasterCriteria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MooraDemoController extends Controller
{
    public function index()
    {
        $results = Results::all();
        $resultDetails = ResultDetails::all();
        $criterias = Criteria::all();
        $masterAlternatives = MasterAlternative::all();
        $masterCriteria = MasterCriteria::all();

        return view('moorademo.index', compact('results', 'resultDetails', 'criterias', 'masterAlternatives', 'masterCriteria'));
    }



    public function storeResult(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'criteria' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            // 1. Buat result baru
            $result = Results::create([
                'TIME_ADDED' => now(),
                'USER_ID' => $request->user_id
            ]);

            // 2. Mapping angka ke teks
            $textWeight = [
                4 => 'Sangat Penting',
                3 => 'Penting',
                2 => 'Tidak Terlalu Penting',
                1 => 'Tidak Penting',
            ];

            $weights = [];

            // 3. Simpan ke master_criteria
            foreach ($request->criteria as $criteriaId => $weightInt) {
                MasterCriteria::create([
                    'USER_ID' => $request->user_id,
                    'WEIGHT_TXT' => $textWeight[$weightInt] ?? 'Tidak Diketahui',
                    'WEIGHT_INT' => $weightInt,
                    'CRITERIA_ID' => $criteriaId,
                    'RESULT_ID' => $result->RESULT_ID,
                ]);

                $weights[$criteriaId] = $weightInt;
            }

            // 4. Ambil semua data master_alternatives
            $alternatives = MasterAlternative::all();

            // 5. Normalisasi dan hitung skor MOORA
            $matrix = [];
            $squares = [];

            // Hitung penyebut (akar dari jumlah kuadrat untuk setiap kriteria)
            foreach ($alternatives as $alt) {
                $matrix[$alt->FISH_ID][$alt->CRITERIA_ID] = $alt->VALUE;
                $squares[$alt->CRITERIA_ID] = ($squares[$alt->CRITERIA_ID] ?? 0) + pow($alt->VALUE, 2);
            }

            foreach ($squares as $c => $val) {
                $squares[$c] = sqrt($val);
            }

            // Hitung nilai preferensi setiap alternatif
            $scores = [];

            foreach ($matrix as $fishId => $criterias) {
                $benefit = 0;
                $cost = 0;

                foreach ($criterias as $criteriaId => $value) {
                    $norm = $squares[$criteriaId] ? $value / $squares[$criteriaId] : 0;
                    $weighted = $norm * $weights[$criteriaId];

                    // Tentukan tipe kriteria
                    $criteriaType = DB::table('criteria')->where('CRITERIA_ID', $criteriaId)->value('TYPE');

                    if (strtolower($criteriaType) === 'benefit') {
                        $benefit += $weighted;
                    } else {
                        $cost += $weighted;
                    }
                }

                $scores[$fishId] = $benefit - $cost;
            }

            // 6. Ranking
            arsort($scores); // urutkan dari skor tertinggi ke terendah
            $ranking = 1;

            foreach ($scores as $fishId => $score) {
                ResultDetails::create([
                    'RESULT_DETAIL_ID' => Str::uuid(),
                    'RANKING' => $ranking++,
                    'RESULT_ID' => $result->RESULT_ID,
                    'FISH_ID' => $fishId,
                    'SCORE' => $score
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil disimpan dan dihitung.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }




}