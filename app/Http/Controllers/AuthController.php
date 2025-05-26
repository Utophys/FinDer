<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function show()
    {
        if (auth()->check()) {
            $user = Auth::user();

            if ($user->ROLE === 'admin') {
                return redirect()->route('admin.fishes.index');
            }

            return redirect()->route('homepage');
        }

        $activePanel = session('active_panel', 'login');
        return view('login_register', compact('activePanel'));
    }

    // fungsi login
    public function login(Request $request)
    {   
        // inisialisasi validator
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // exception handling input user kalo ga cocok
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // kalo ga sesuai, redirect ke login
        if ($validator->fails()) {
            return redirect()->route('auth.show')
                ->withErrors($validator, 'login')
                ->withInput()
                ->with('active_panel', 'login');
        }

        // ngecek kredensial dan ngecek remember me token
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // kalo admin
            if ($user->ROLE === 'admin') {
                return redirect()->route('admin.fishes.index');
            }

            return redirect()->route('homepage');
        }

        // kalo gagal login
        return redirect()->route('auth.show')
            ->withErrors(['email' => 'Email atau Password yang anda isi salah!'], 'login')
            ->withInput()
            ->with('active_panel', 'login');
    }

    // fungsi register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9 ]+$/'],
            'email' => 'required|string|email|max:40|unique:user_account,EMAIL',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/'
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.regex' => 'Nama hanya boleh mengandung huruf, angka, dan spasi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.show')
                ->withErrors($validator, 'register')
                ->withInput()
                ->with('active_panel', 'register');
        }

        User::create([
            'USER_ID' => (string) Str::uuid(),
            'USERNAME' => $request->name,
            'DISPLAY_NAME' => $request->name,
            'PASSWORD' => Hash::make($request->password),
            'ROLE' => 'user',
            'EMAIL' => $request->email,
            'IMAGE' => '',
            'IS_DELETED' => 0,
        ]);

        return redirect()->route('auth.show')
            ->with('success', 'Registrasi Berhasil!.')
            ->with('active_panel', 'login');
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user) {
            $user->remember_token = null;
            $user->save();
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); 
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('EMAIL', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'USER_ID' => (string) Str::uuid(),
                    'USERNAME' => $googleUser->getName(),
                    'DISPLAY_NAME' => $googleUser->getName(),
                    'EMAIL' => $googleUser->getEmail(),
                    'PASSWORD' => Hash::make(Str::random(16)),
                    'ROLE' => 'user',
                    'IMAGE' => $googleUser->getAvatar(),
                    'IS_DELETED' => 0,

                ]);
            }

            Auth::login($user, true);

            return redirect()->intended('/user/homepage');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Google login failed.']);
        }
    }
}
