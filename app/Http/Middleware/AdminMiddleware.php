<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User; // Jangan lupa import model User

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Gunakan method yang lebih bersih untuk pengecekan
        if (!$user || $user->ROLE !== 'admin') {
            // Pesan ini akan muncul di halaman error 403 kustom Anda
            abort(403, 'Akses ditolak. Halaman ini khusus untuk Administrator.');
        }

        return $next($request);
    }
}