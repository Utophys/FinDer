<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\AlternativeFish;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.show');
        }

        $randomFish = AlternativeFish::query()
            ->whereNotNull('IMAGE')
            ->where('IS_VERIFIED', 1)
            ->where('IS_DELETED', 0)
            ->inRandomOrder()
            ->first();

        if (!$randomFish) {
            $randomFish = AlternativeFish::inRandomOrder()->first();
        }

        $alternativeFishes = AlternativeFish::where('FISH_ID', '!=', $randomFish->FISH_ID)
            ->where('IS_VERIFIED', 1)
            ->where('IS_DELETED', 0)
            ->inRandomOrder()
            ->limit(12)
            ->get();

        return view('user.homepage', compact('randomFish', 'alternativeFishes'));
    }
}
