<?php

namespace App\Http\Controllers;

use App\Models\AlternativeFish;
use App\Models\Criteria;
use App\Models\Variety;
use App\Models\MasterAlternative;
use Illuminate\Http\Request;

class FishController extends Controller
{
    public function show($id)
    {
        $fish = AlternativeFish::with('food')
            ->where('IS_VERIFIED', 1)
            ->where('IS_DELETED', 0)
            ->findOrFail($id);

        $criteria = $this->getFishCriteria($fish->FISH_ID);

        $groupedCriteria = [
            'Umum' => $criteria->whereIn('NAME', ['Harga', 'Kelangkaan', 'Perilaku']),
            'Pemeliharaan' => $criteria->whereIn('NAME', ['Biaya Pemeliharaan', 'Ukuran', 'Kompleksitas Pemeliharaan', 'Estetika']),
        ];

        $relatedFishes = AlternativeFish::where('FOOD_ID', $fish->FOOD_ID)
            ->where('FISH_ID', '!=', $id)
            ->where('IS_VERIFIED', 1)
            ->where('IS_DELETED', 0)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('user.fish_detail', [
            'fish' => $fish,
            'groupedCriteria' => $groupedCriteria,
            'relatedFishes' => $relatedFishes,
            'varieties' => $this->getFishVarieties($fish->NAME)
        ]);
    }

    protected function getFishCriteria($fishId)
    {
        return MasterAlternative::join('criteria', 'master_alternatives.CRITERIA_ID', '=', 'criteria.CRITERIA_ID')
            ->where('master_alternatives.FISH_ID', $fishId)
            ->select('criteria.CRITERIA_ID', 'criteria.NAME', 'criteria.TYPE', 'master_alternatives.VALUE')
            ->get()
            ->map(function ($item) {
                $item->DISPLAY_VALUE = $item->TYPE === 'cost'
                    ? 'Rp ' . number_format((int)$item->VALUE, 0, ',', '.')
                    : $this->getRatingStars((float)$item->VALUE);
                return $item;
            });
    }

    protected function getRatingStars($value)
    {
        $stars = '';
        $full = floor($value);
        $half = ($value - $full) >= 0.5;

        for ($i = 0; $i < 5; $i++) {
            if ($i < $full) {
                $stars .= '★';
            } elseif ($i == $full && $half) {
                $stars .= '½';
            } else {
                $stars .= '☆';
            }
        }

        return $stars;
    }

    protected function getFishVarieties($fishId)
    {
        return Variety::where('FISH_ID', $fishId)
            ->where('IS_DELETED', 0)
            ->get();
    }
}
