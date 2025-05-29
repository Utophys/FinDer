<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\AlternativeFish;
use App\Models\Criteria;
use App\Models\Results;
use App\Models\ResultDetails;
use App\Models\MasterAlternative;
use App\Models\MasterCriteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MooraController extends Controller
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
            return redirect()->route('user.dss.results', ['result_id' => $result->RESULT_ID])
                ->with('success', 'Kuesioner berhasil diproses! Berikut adalah hasilnya.');


        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($result_id)
    {
        // --------- 1. Ambil Data Dasar ---------
        $result = Results::find($result_id);
        if (!$result) {
            return redirect()->route('user.dss.questions') // Ganti dengan route kuesioner Anda
                ->with('error', 'Data hasil tidak ditemukan.');
        }

        // Ambil bobot yang digunakan pengguna untuk hasil ini
        $userCriteriaWeights = MasterCriteria::where('RESULT_ID', $result_id)
            ->pluck('WEIGHT_INT', 'CRITERIA_ID')
            ->all();

        if (empty($userCriteriaWeights)) {
            return redirect()->route('user.dss.questions')
                ->with('error', 'Data bobot kriteria untuk hasil ini tidak ditemukan.');
        }

        $allCriteria = Criteria::orderBy('CRITERIA_ID')->get(); // Urutkan agar konsisten
        $allAlternatives = AlternativeFish::orderBy('FISH_ID')->get(); // Urutkan agar konsisten, pastikan model ini ada
        $masterAlternativesData = MasterAlternative::all();

        // --------- 2. Bangun Matriks Keputusan Awal (Xij) ---------
        // Format: $initialMatrix[FISH_ID][CRITERIA_ID] = VALUE
        $initialMatrix = [];
        foreach ($allAlternatives as $alt) {
            foreach ($allCriteria as $crit) {
                $masterValue = $masterAlternativesData
                    ->where('FISH_ID', $alt->FISH_ID)
                    ->where('CRITERIA_ID', $crit->CRITERIA_ID)
                    ->first();
                $initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] = $masterValue ? $masterValue->VALUE : 0;
            }
        }

        // --------- 3. Hitung Pembagi untuk Normalisasi (Akar dari Jumlah Kuadrat) ---------
        // Format: $denominatorSquares[CRITERIA_ID] = sqrt(sum(Xij^2))
        $denominatorSquares = [];
        foreach ($allCriteria as $crit) {
            $sumOfSquares = 0;
            foreach ($allAlternatives as $alt) {
                $value = $initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $sumOfSquares += pow($value, 2);
            }
            $denominatorSquares[$crit->CRITERIA_ID] = sqrt($sumOfSquares);
        }

        // --------- 4. Hitung Matriks Ternormalisasi (X*ij) ---------
        // Format: $normalizedMatrix[FISH_ID][CRITERIA_ID] = Xij / Denominator
        $normalizedMatrix = [];
        foreach ($allAlternatives as $alt) {
            foreach ($allCriteria as $crit) {
                $value = $initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $denominator = $denominatorSquares[$crit->CRITERIA_ID] ?? 1; // Hindari pembagian dengan 0
                $normalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] = $denominator ? $value / $denominator : 0;
            }
        }

        // --------- 5. Hitung Matriks Ternormalisasi Terbobot (Yij) ---------
        // Format: $weightedNormalizedMatrix[FISH_ID][CRITERIA_ID] = X*ij * Wj
        $weightedNormalizedMatrix = [];
        foreach ($allAlternatives as $alt) {
            foreach ($allCriteria as $crit) {
                $normalizedValue = $normalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $weight = $userCriteriaWeights[$crit->CRITERIA_ID] ?? 0;
                $weightedNormalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] = $normalizedValue * $weight;
            }
        }

        // --------- 6. Hitung Jumlah Benefit dan Cost untuk Setiap Alternatif ---------
        // Format: $benefitCostSums[FISH_ID] = ['benefit' => sum, 'cost' => sum]
        $benefitCostSums = [];
        foreach ($allAlternatives as $alt) {
            $sumBenefit = 0;
            $sumCost = 0;
            foreach ($allCriteria as $crit) {
                $weightedValue = $weightedNormalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                if (strtolower($crit->TYPE) === 'benefit') {
                    $sumBenefit += $weightedValue;
                } else { // Cost
                    $sumCost += $weightedValue;
                }
            }
            $benefitCostSums[$alt->FISH_ID] = [
                'benefit' => $sumBenefit,
                'cost' => $sumCost,
            ];
        }

        // --------- 7. Ambil Hasil Akhir (Skor dan Peringkat) dari Database ---------
        // Ini sudah ada dari kode Anda sebelumnya
        $rankedFishDetails = ResultDetails::with('fish')
            ->byResult($result_id)
            ->ordered()
            ->get();

        if ($rankedFishDetails->isEmpty()) {
            return redirect()->route('user.dss.questions')
                ->with('error', 'Detail hasil rekomendasi tidak ditemukan.');
        }

        $top1FishDetail = $rankedFishDetails->first();
        $otherConsiderations = $rankedFishDetails->slice(1, 4);

        // --------- 8. Siapkan data untuk dikirim ke view ---------
        $calculationData = [
            'userWeights' => $userCriteriaWeights,
            'allCriteria' => $allCriteria, // Untuk nama dan tipe kriteria
            'allAlternatives' => $allAlternatives, // Untuk nama alternatif
            'initialMatrix' => $initialMatrix,
            'denominatorSquares' => $denominatorSquares,
            'normalizedMatrix' => $normalizedMatrix,
            'weightedNormalizedMatrix' => $weightedNormalizedMatrix,
            'benefitCostSums' => $benefitCostSums,
            'rankedFishDetails' => $rankedFishDetails // Mengandung skor akhir dan peringkat
        ];

        return view('user.dss.results', [ // Path ke view Anda
            'top1FishDetail' => $top1FishDetail,
            'otherConsiderations' => $otherConsiderations,
            'calculationData' => $calculationData, // Kirim data kalkulasi
            'resultId' => $result_id // Kirim juga result_id jika diperlukan di view
        ]);
    }

    // Opsional: Method untuk mengambil hasil terbaru pengguna yang login
    public function showLatest()
    {
        $latestResult = Results::where('USER_ID', Auth::id())
            ->orderBy('TIME_ADDED', 'desc')
            ->first();

        if (!$latestResult) {
            return redirect()->route('user.dss.questions') // Ganti dengan route kuesioner Anda
                ->with('error', 'Anda belum pernah mengisi kuesioner.');
        }
        // Redirect ke method show dengan RESULT_ID terbaru
        return redirect()->route('user.dss.showResult', ['result_id' => $latestResult->RESULT_ID]);
    }

    public function showCalculation($result_id)
    {
        // --------- 1. Ambil Data Dasar ---------
        $result = Results::find($result_id);
        if (!$result) {
            return redirect()->route('user.dss.questions')->with('error', 'Data hasil tidak ditemukan.');
        }

        $userCriteriaWeights = MasterCriteria::where('RESULT_ID', $result_id)
            ->pluck('WEIGHT_INT', 'CRITERIA_ID')
            ->all();

        if (empty($userCriteriaWeights)) {
            return redirect()->route('user.dss.questions')
                ->with('error', 'Data bobot kriteria untuk hasil ini tidak ditemukan.');
        }

        $allCriteria = Criteria::orderBy('CRITERIA_ID')->get();
        $allAlternatives = AlternativeFish::orderBy('FISH_ID')->get();
        $masterAlternativesData = MasterAlternative::all();

        // --------- 2. Bangun Matriks Keputusan Awal (Xij) ---------
        $initialMatrix = [];
        foreach ($allAlternatives as $alt) {
            foreach ($allCriteria as $crit) {
                $masterValue = $masterAlternativesData
                    ->where('FISH_ID', $alt->FISH_ID)
                    ->where('CRITERIA_ID', $crit->CRITERIA_ID)
                    ->first();
                $initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] = $masterValue ? $masterValue->VALUE : 0;
            }
        }

        // --------- 3. Hitung Pembagi untuk Normalisasi ---------
        $denominatorSquares = [];
        foreach ($allCriteria as $crit) {
            $sumOfSquares = 0;
            foreach ($allAlternatives as $alt) {
                $value = $initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $sumOfSquares += pow($value, 2);
            }
            // Hindari pembagian dengan nol jika semua nilai untuk kriteria adalah 0
            $denominatorSquares[$crit->CRITERIA_ID] = ($sumOfSquares > 0) ? sqrt($sumOfSquares) : 1;
        }

        // --------- 4. Hitung Matriks Ternormalisasi ---------
        $normalizedMatrix = [];
        foreach ($allAlternatives as $alt) {
            foreach ($allCriteria as $crit) {
                $value = $initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $denominator = $denominatorSquares[$crit->CRITERIA_ID];
                $normalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] = $denominator != 0 ? $value / $denominator : 0;
            }
        }

        // --------- 5. Hitung Matriks Ternormalisasi Terbobot ---------
        $weightedNormalizedMatrix = [];
        foreach ($allAlternatives as $alt) {
            foreach ($allCriteria as $crit) {
                $normalizedValue = $normalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $weight = $userCriteriaWeights[$crit->CRITERIA_ID] ?? 0;
                $weightedNormalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] = $normalizedValue * $weight;
            }
        }

        // --------- 6. Hitung Jumlah Benefit dan Cost ---------
        $benefitCostSums = [];
        foreach ($allAlternatives as $alt) {
            $sumBenefit = 0;
            $sumCost = 0;
            foreach ($allCriteria as $crit) {
                $weightedValue = $weightedNormalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                if (strtolower($crit->TYPE) === 'benefit') {
                    $sumBenefit += $weightedValue;
                } else { // Cost
                    $sumCost += $weightedValue;
                }
            }
            $benefitCostSums[$alt->FISH_ID] = [
                'benefit' => $sumBenefit,
                'cost' => $sumCost,
            ];
        }

        // --------- 7. Ambil Hasil Akhir (Skor dan Peringkat) ---------
        $rankedFishDetails = ResultDetails::with('fish')
            ->byResult($result_id)
            ->ordered()
            ->get();

        if ($rankedFishDetails->isEmpty()) {
            return redirect()->route('user.dss.questions')->with('error', 'Detail hasil rekomendasi tidak ditemukan.');
        }

        $top1FishDetail = $rankedFishDetails->first();
        $otherConsiderations = $rankedFishDetails->slice(1, 4);

        // --------- 8. Siapkan data untuk dikirim ke view ---------
        $calculationData = [
            'userWeights' => $userCriteriaWeights,
            'allCriteria' => $allCriteria,
            'allAlternatives' => $allAlternatives,
            'initialMatrix' => $initialMatrix,
            'denominatorSquares' => $denominatorSquares,
            'normalizedMatrix' => $normalizedMatrix,
            'weightedNormalizedMatrix' => $weightedNormalizedMatrix,
            'benefitCostSums' => $benefitCostSums,
            'rankedFishDetails' => $rankedFishDetails
        ];

        // Menggunakan view yang sama (user.dss.results) yang sudah Anda buat,
        // karena view tersebut sudah dirancang untuk menampilkan kalkulasi jika $calculationData ada.
        return view('user.dss.calculation', [
            'top1FishDetail' => $top1FishDetail,
            'otherConsiderations' => $otherConsiderations,
            'calculationData' => $calculationData,
            'resultId' => $result_id,
            'result' => $result // ← add this line
        ]);
    }
}
