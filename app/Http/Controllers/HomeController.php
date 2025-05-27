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
        if (!Auth::check()) {
            return redirect()->route('login'); // Pastikan route 'login' ada
        }

        $userId = Auth::id();
        $heroFish = null;
        $isFromSPK = false;
        $noSPKResultYet = false; // Flag baru: true jika user belum pernah SPK

        // 1. Cari RESULT_ID terbaru untuk pengguna yang login
        $latestResult = Results::where('USER_ID', $userId)
                               ->orderBy('TIME_ADDED', 'desc')
                               ->first();

        if (!$latestResult) {
            // Pengguna belum pernah melakukan SPK
            $noSPKResultYet = true;
            // Kita tetap bisa memuat ikan random untuk bagian $alternativeFishes
            // atau jika Anda ingin hero section tetap ada background ikan random saat pesan selamat datang.
            // Jika tidak, $heroFish bisa tetap null dan Blade akan menampilkan pesan selamat datang saja.
            // Untuk contoh ini, kita tetap load $heroFish random agar $alternativeFishes bisa di-filter
            // dan untuk kasus jika Anda mau ada gambar background di pesan selamat datang.
             $heroFish = AlternativeFish::query()
                ->whereNotNull('IMAGE')
                ->where('IS_VERIFIED', 1)
                ->where('IS_DELETED', 0)
                ->inRandomOrder()
                ->first();
            if (!$heroFish) { // Fallback jika query diatas kosong
                 $heroFish = AlternativeFish::inRandomOrder()->first();
            }

        } else {
            // Pengguna sudah pernah SPK, coba tampilkan hasil ranking 1
            $noSPKResultYet = false;
            $topRankedDetail = ResultDetails::where('RESULT_ID', $latestResult->RESULT_ID)
                                            ->where('RANKING', 1)
                                            ->first();

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

        return view('user.homepage', compact('heroFish', 'alternativeFishes', 'isFromSPK', 'noSPKResultYet'));
    }
}