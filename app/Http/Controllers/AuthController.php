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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            // Validasi Turnstile menggunakan closure
            'cf-turnstile-response' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $secretKey = env('CLOUDFLARE_TURNSTILE_SECRET_KEY');

                    if (!$secretKey) {
                        Log::error('Cloudflare Turnstile Secret Key is not set in .env file.');
                        $fail('Konfigurasi keamanan tidak lengkap. Silakan coba lagi nanti.');
                        return;
                    }

                    try {
                        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                            'secret' => $secretKey,
                            'response' => $value,
                            'remoteip' => $request->ip(),
                        ]);

                        if (!$response->successful()) {
                            Log::error('Cloudflare Turnstile API request failed for login.', [
                                'status' => $response->status(),
                                'body' => $response->body()
                            ]);
                            $fail('Gagal menghubungi server verifikasi. Silakan coba lagi.');
                            return;
                        }

                        $body = $response->json();

                        if (!(isset($body['success']) && $body['success'] === true)) {
                            Log::warning('Cloudflare Turnstile verification failed for login.', [
                                'error-codes' => $body['error-codes'] ?? 'N/A',
                                'response_body' => $body
                            ]);
                            $fail('Verifikasi CAPTCHA gagal. Silakan coba lagi.');
                        }
                    } catch (\Exception $e) {
                        Log::error('Exception during Cloudflare Turnstile verification for login.', [
                            'message' => $e->getMessage(),
                        ]);
                        $fail('Terjadi kesalahan saat verifikasi keamanan. Silakan coba lagi.');
                    }
                }
            ],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'cf-turnstile-response.required' => 'Mohon verifikasi bahwa Anda bukan robot.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.show')
                ->withErrors($validator, 'login') // Pastikan error bag adalah 'login'
                ->withInput($request->except('password')) // Jangan kirim ulang password
                ->with('active_panel', 'login');
        }

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->IS_DELETED == 1) {
                Auth::logout();
                return redirect()->route('auth.show')
                    ->withErrors(['email' => 'Akun sudah tidak ada coba hubungi Admin'], 'login')
                    ->withInput($request->except('password'))
                    ->with('active_panel', 'login');
            }

            // Regenerate session ID untuk keamanan setelah login berhasil
            $request->session()->regenerate();

            if ($user->ROLE === 'admin') {
                return redirect()->intended(route('admin.fishes.index')); // Gunakan intended untuk redirect setelah login
            }

            return redirect()->intended(route('homepage')); // Gunakan intended
        }

        return redirect()->route('auth.show')
            ->withErrors(['email' => 'Email atau Password yang anda isi salah!'], 'login')
            ->withInput($request->except('password'))
            ->with('active_panel', 'login');
    }

    // fungsi register
    public function register(Request $request)
    {
        $existingUser = User::where('EMAIL', $request->email)->first();
        if ($existingUser && $existingUser->IS_DELETED == 1) {
            return redirect()->route('auth.show')
                ->withErrors(['email' => 'Akun sudah tidak ada coba hubungi Admin'], 'register')
                ->withInput()
                ->with('active_panel', 'register');
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9 ]+$/'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:user_account,EMAIL' // Pastikan nama tabel dan kolom sudah benar
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*()_+\-=]/'
            ],
            // Validasi Turnstile menggunakan closure
            'cf-turnstile-response' => [
                'required',
                function ($attribute, $value, $fail) use ($request) { // Tambahkan 'use ($request)' jika butuh $request->ip()
                    $secretKey = env('CLOUDFLARE_TURNSTILE_SECRET_KEY');

                    if (!$secretKey) {
                        Log::error('Cloudflare Turnstile Secret Key is not set in .env file.');
                        // Pesan error yang lebih umum untuk pengguna
                        $fail('Konfigurasi keamanan tidak lengkap. Silakan coba lagi nanti.');
                        return;
                    }

                    try {
                        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                            'secret' => $secretKey,
                            'response' => $value,
                            'remoteip' => $request->ip(), // Mengirim IP pengguna (opsional namun direkomendasikan)
                        ]);

                        if (!$response->successful()) {
                            Log::error('Cloudflare Turnstile API request failed.', [
                                'status' => $response->status(),
                                'body' => $response->body()
                            ]);
                            $fail('Gagal menghubungi server verifikasi. Silakan coba lagi.');
                            return;
                        }

                        $body = $response->json();

                        if (!(isset($body['success']) && $body['success'] === true)) {
                            Log::warning('Cloudflare Turnstile verification failed.', [
                                'error-codes' => $body['error-codes'] ?? 'N/A',
                                'response_body' => $body
                            ]);
                            // Pesan ini akan ditampilkan jika verifikasi gagal
                            $fail('Verifikasi CAPTCHA gagal. Silakan coba lagi.');
                        }
                    } catch (\Exception $e) {
                        Log::error('Exception during Cloudflare Turnstile verification.', [
                            'message' => $e->getMessage(),
                        ]);
                        $fail('Terjadi kesalahan saat verifikasi keamanan. Silakan coba lagi.');
                    }
                }
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
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol (!@#$%^&*()_-+=).',
            // Pesan untuk aturan 'required' pada Turnstile
            'cf-turnstile-response.required' => 'Mohon verifikasi bahwa Anda bukan robot.',
            // Pesan error dari closure akan ditampilkan jika validasi Turnstile gagal
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
            'SET_PASSWORD' => 1,
            'ROLE' => 'user',
            'EMAIL' => $request->email,
            'IMAGE' => '',
            'IS_DELETED' => 0,
        ]);

        return redirect()->route('auth.show')
            ->with('success', 'Registrasi Berhasil! Silakan login.')
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

            if ($user) {
                if ($user->IS_DELETED == 1) {
                    return redirect()->route('auth.show')
                        ->withErrors(['email' => 'Akun sudah tidak ada coba hubungi Admin'], 'login')
                        ->with('active_panel', 'login');
                }
            } else {
                $user = User::create([
                    'USER_ID' => (string) Str::uuid(),
                    'USERNAME' => $googleUser->getName(),
                    'DISPLAY_NAME' => $googleUser->getName(),
                    'EMAIL' => $googleUser->getEmail(),
                    'PASSWORD' => Hash::make(Str::random(16)),
                    'SET_PASSWORD' => 0,
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
