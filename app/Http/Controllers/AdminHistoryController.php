<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\ResultDetails;
use App\Models\Criteria;
use App\Models\AlternativeFish;
use App\Models\Results;
use App\Models\MasterAlternative;
use App\Models\MasterCriteria;

class AdminHistoryController extends Controller
{

    public function showAllUserDSSHistory()
    {
        $results = DB::table('result')
            ->join('user_account', 'result.USER_ID', '=', 'user_account.USER_ID')
            ->where('user_account.IS_DELETED', 0)
            ->orderBy('result.TIME_ADDED', 'desc')
            ->select('result.*', 'user_account.DISPLAY_NAME', 'user_account.EMAIL')
            ->get();


        if ($results->isEmpty()) {
            return view('admin.user-results.index', ['resultsWithDetails' => []]);
        }

        $resultsWithDetails = [];

        foreach ($results as $result) {
            $details = DB::table('result_detail')
                ->join('alternative_fish', 'result_detail.FISH_ID', '=', 'alternative_fish.FISH_ID')
                ->select('alternative_fish.NAME as fish_name', 'alternative_fish.IMAGE', 'result_detail.RANKING', 'result_detail.SCORE', 'result_detail.FISH_ID')
                ->where('result_detail.RESULT_ID', $result->RESULT_ID)
                ->orderBy('result_detail.RANKING')
                ->get();

            $criteria = DB::table('master_criteria')
                ->where('RESULT_ID', $result->RESULT_ID)
                ->get();

            $user = (object) [
                'DISPLAY_NAME' => $result->DISPLAY_NAME,
                'EMAIL' => $result->EMAIL
            ];

            $resultsWithDetails[] = [
                'result' => $result,
                'details' => $details,
                'criteria' => $criteria,
                'user' => $user,
            ];
        }


        return view('admin.user-results.index', compact('resultsWithDetails'));
    }


    public function showCalculationForAdmin($result_id)
    {
        $result = Results::find($result_id);
        if (!$result) {
            return redirect()->route('admin.dss.history')->with('error', 'Data hasil tidak ditemukan.');
        }

        $userCriteriaWeights = MasterCriteria::where('RESULT_ID', $result_id)
            ->pluck('WEIGHT_INT', 'CRITERIA_ID')
            ->all();

        if (empty($userCriteriaWeights)) {
            return redirect()->route('admin.dss.history')
                ->with('error', 'Data bobot kriteria untuk hasil ini tidak ditemukan.');
        }

        $allCriteria = Criteria::orderBy('CRITERIA_ID')->get();
        // Ambil FISH_ID yang relevan dari result_detail
        $fishesInResult = ResultDetails::where('RESULT_ID', $result_id)
            ->pluck('FISH_ID')
            ->unique()
            ->values();

        // Ambil alternatif ikan berdasarkan FISH_ID yang ada di result_detail
        $allAlternatives = AlternativeFish::whereIn('FISH_ID', $fishesInResult)
            ->orderBy('FISH_ID')
            ->get();

        // Ambil data master_alternative berdasarkan FISH_ID yang ada di result_detail
        $masterAlternativesData = MasterAlternative::whereIn('FISH_ID', $fishesInResult)->get();

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

        $denominatorSquares = [];
        foreach ($allCriteria as $crit) {
            $sumOfSquares = 0;
            foreach ($allAlternatives as $alt) {
                $value = $initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $sumOfSquares += pow($value, 2);
            }
            $denominatorSquares[$crit->CRITERIA_ID] = ($sumOfSquares > 0) ? sqrt($sumOfSquares) : 1;
        }

        $normalizedMatrix = [];
        foreach ($allAlternatives as $alt) {
            foreach ($allCriteria as $crit) {
                $value = $initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $denominator = $denominatorSquares[$crit->CRITERIA_ID];
                $normalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] = $denominator != 0 ? $value / $denominator : 0;
            }
        }

        $weightedNormalizedMatrix = [];
        foreach ($allAlternatives as $alt) {
            foreach ($allCriteria as $crit) {
                $normalizedValue = $normalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                $weight = $userCriteriaWeights[$crit->CRITERIA_ID] ?? 0;
                $weightedNormalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] = $normalizedValue * $weight;
            }
        }

        $benefitCostSums = [];
        foreach ($allAlternatives as $alt) {
            $sumBenefit = 0;
            $sumCost = 0;
            foreach ($allCriteria as $crit) {
                $weightedValue = $weightedNormalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0;
                if (strtolower($crit->TYPE) === 'benefit') {
                    $sumBenefit += $weightedValue;
                } else {
                    $sumCost += $weightedValue;
                }
            }
            $benefitCostSums[$alt->FISH_ID] = [
                'benefit' => $sumBenefit,
                'cost' => $sumCost,
            ];
        }

        $rankedFishDetails = ResultDetails::with('fish')
            ->byResult($result_id)
            ->ordered()
            ->get();

        if ($rankedFishDetails->isEmpty()) {
            return redirect()->route('admin.dss.history')->with('error', 'Detail hasil rekomendasi tidak ditemukan.');
        }

        $top1FishDetail = $rankedFishDetails->first();
        $otherConsiderations = $rankedFishDetails->slice(1, 4);

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

        return view('admin.user-results.admincalculation', [
            'top1FishDetail' => $top1FishDetail,
            'otherConsiderations' => $otherConsiderations,
            'calculationData' => $calculationData,
            'resultId' => $result_id,
            'result' => $result
        ]);

    }
}
