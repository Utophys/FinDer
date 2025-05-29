<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\AlternativeFish;
use App\Models\Results;
use App\Models\ResultDetails;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return redirect()->route('/');
        }

        if ($user->IS_DELETED == 1) {
            Auth::logout();
            return redirect('/');
        }


        $userId = Auth::id();
        $heroFish = null;
        $isFromSPK = false;
        $noSPKResultYet = false;
        $showPasswordAlert = Auth::user()->SET_PASSWORD == 0;
        $latestResult = Results::where('USER_ID', $userId)
            ->orderBy('TIME_ADDED', 'desc')
            ->first();

        if (!$latestResult) {
            $noSPKResultYet = true;
            $heroFish = AlternativeFish::query()
                ->whereNotNull('IMAGE')
                ->where('IS_VERIFIED', 1)
                ->where('IS_DELETED', 0)
                ->inRandomOrder()
                ->first();
            if (!$heroFish) {
                $heroFish = AlternativeFish::inRandomOrder()->first();
            }
        } else {
            $noSPKResultYet = false;
            $topRankedDetail = ResultDetails::where('RESULT_ID', $latestResult->RESULT_ID)
                ->where('RANKING', 1)
                ->first();
            $user = Auth::user();

            if ($topRankedDetail) {
                $fetchedHeroFish = AlternativeFish::find($topRankedDetail->FISH_ID);
                // Pastikan ikan ditemukan dan memiliki gambar
                if ($fetchedHeroFish && $fetchedHeroFish->IMAGE) {
                    $heroFish = $fetchedHeroFish;
                    $isFromSPK = true;
                }
            }

            // Fallback ke ikan random HANYA jika hasil SPK ada tapi ikan ranking 1 bermasalah
            if (!$heroFish) { // Ini berarti $isFromSPK akan tetap/menjadi false
                $heroFish = AlternativeFish::query()
                    ->whereNotNull('IMAGE')
                    ->where('IS_VERIFIED', 1)
                    ->where('IS_DELETED', 0)
                    ->inRandomOrder()
                    ->first();
                if (!$heroFish) { // Fallback jika query diatas kosong
                    $heroFish = AlternativeFish::inRandomOrder()->first();
                }
                $isFromSPK = false; // Karena ini adalah fallback, bukan hasil SPK langsung
            }
        }

        // Ambil ikan alternatif lainnya
        $alternativeFishesQuery = AlternativeFish::query()
            ->where('IS_VERIFIED', 1)
            ->where('IS_DELETED', 0);

        if ($heroFish) { // Pastikan heroFish tidak sama dengan ikan alternatif
            $alternativeFishesQuery->where('FISH_ID', '!=', $heroFish->FISH_ID);
        }

        $alternativeFishes = $alternativeFishesQuery->inRandomOrder()
            ->limit(12)
            ->get();

        return view('user.homepage', compact('heroFish', 'alternativeFishes', 'isFromSPK', 'noSPKResultYet', 'showPasswordAlert'));
    }
}
