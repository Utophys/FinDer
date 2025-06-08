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
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter; 

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
                ->withErrors($validator, 'login')
                ->withInput($request->except('password'))
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

            $request->session()->regenerate();

            if ($user->ROLE === 'admin') {
                return redirect()->intended(route('admin.fishes.index'));
            }

            return redirect()->intended(route('homepage'));
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
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol (!@#$%^&*()_-+=).',
            'cf-turnstile-response.required' => 'Mohon verifikasi bahwa Anda bukan robot.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.show')
                ->withErrors($validator, 'register')
                ->withInput()
                ->with('active_panel', 'register');
        }

        if (User::where('EMAIL', $request->email)->exists()) {
             return redirect()->route('auth.show')
                ->withErrors(['email' => 'Email sudah terdaftar.'], 'register')
                ->withInput()
                ->with('active_panel', 'register');
        }

        try {
            DB::beginTransaction();

            $verificationCode = Str::random(6);
            $expiresAt = Carbon::now()->addMinutes(15);

            DB::table('email_verifications')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => $verificationCode,
                    'expires_at' => $expiresAt,
                    'data' => json_encode([
                        'username' => $request->name,
                        'display_name' => $request->name,
                        'password' => Hash::make($request->password),
                        'set_password' => 1,
                        'role' => 'user',
                        'image' => '',
                        'phone_number' => NULL,
                        'is_deleted' => 0,
                    ]),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

            Mail::to($request->email)->send(new EmailVerificationMail($verificationCode));

            DB::commit();

            return redirect()->route('auth.verify.form')
                ->with('success', 'Kode verifikasi telah dikirim ke email Anda. Silakan cek kotak masuk Anda.')
                ->with('email', $request->email);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration 2FA failed: ' . $e->getMessage());
            return redirect()->route('auth.show')
                ->withErrors(['register' => 'Terjadi kesalahan saat melakukan registrasi. Silakan coba lagi.'], 'register')
                ->withInput()
                ->with('active_panel', 'register');
        }
    }

    /**
     * Show the email verification form.
     */
    public function showVerificationForm(Request $request)
    {
        $email = $request->session()->get('email') ?? $request->query('email') ?? old('email');

        if (empty($email)) {
            return redirect()->route('auth.show')
                             ->withErrors(['general' => 'Email verifikasi tidak ditemukan. Silakan daftar ulang atau masuk.'], 'register')
                             ->with('active_panel', 'register');
        }

        return view('auth.verify_email', compact('email'));
    }

    /**
     * Handle email verification.
     */
    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'verification_code' => 'required|string|min:6|max:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'verification_code.required' => 'Kode verifikasi wajib diisi.',
            'verification_code.min' => 'Kode verifikasi harus 6 karakter.',
            'verification_code.max' => 'Kode verifikasi harus 6 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $verificationRecord = DB::table('email_verifications')
                ->where('email', $request->email)
                ->first();

            if (!$verificationRecord) {
                DB::rollBack();
                return redirect()->back()->withErrors(['verification_code' => 'Email atau kode verifikasi tidak valid.'])->withInput();
            }

            if (
                $verificationRecord->token !== $request->verification_code ||
                Carbon::parse($verificationRecord->expires_at)->isPast()
            ) {
                Log::warning('Email verification failed for ' . $request->email . '. Code mismatch or expired.');
                DB::rollBack();
                return redirect()->back()->withErrors(['verification_code' => 'Kode verifikasi salah atau sudah kadaluarsa.'])->withInput();
            }

            $userData = json_decode($verificationRecord->data, true);

            if (User::where('EMAIL', $request->email)->where('IS_DELETED', 0)->exists()) {
                DB::rollBack();
                DB::table('email_verifications')->where('email', $request->email)->delete();
                return redirect()->route('auth.show')
                    ->withErrors(['email' => 'Email sudah terdaftar dan terverifikasi. Silakan login.'], 'login')
                    ->with('active_panel', 'login');
            }

            $user = User::create([
                'USER_ID' => (string) Str::uuid(),
                'USERNAME' => $userData['username'],
                'DISPLAY_NAME' => $userData['display_name'],
                'PASSWORD' => $userData['password'],
                'SET_PASSWORD' => $userData['set_password'],
                'ROLE' => $userData['role'],
                'EMAIL' => $request->email,
                'PHONE_NUMBER' => NULL,
                'IMAGE' => $userData['image'],
                'IS_DELETED' => $userData['is_deleted'],
            ]);

            DB::table('email_verifications')->where('email', $request->email)->delete();

            DB::commit();

            return redirect()->route('auth.show')
                ->with('success', 'Akun Anda berhasil diverifikasi dan terdaftar! Silakan login.')
                ->with('active_panel', 'login');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Email verification process failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['verification_code' => 'Terjadi kesalahan saat verifikasi email. Silakan coba lagi.'])->withInput();
        }
    }

    public function resendVerificationCode(Request $request)
    {
        // Validate the incoming email address
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Apply rate limiting to prevent abuse.
        $throttleKey = 'resend-verification:' . $request->email;
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) { // 3 attempts within 1 minute
            $secondsRemaining = RateLimiter::availableIn($throttleKey);
            return redirect()->back()
                ->withErrors(['email' => "Terlalu banyak permintaan. Silakan coba lagi setelah {$secondsRemaining} detik."])
                ->withInput(['email' => $request->email]);
        }

        try {
            // If not throttled, increment the hit count for this email
            RateLimiter::hit($throttleKey);

            // Find the existing verification record for the email
            $verificationRecord = DB::table('email_verifications')
                ->where('email', $request->email)
                ->first();

            // If no record found, it means the email wasn't registered for 2FA verification
            if (!$verificationRecord) {
                return redirect()->back()
                    ->withErrors(['email' => 'Tidak ada permintaan verifikasi yang ditemukan untuk email ini. Silakan daftar ulang.'])
                    ->withInput(['email' => $request->email]);
            }

            // Generate a new verification code
            $newVerificationCode = Str::random(6);
            // Set new expiration time (e.g., 15 minutes from now)
            $newExpiresAt = Carbon::now()->addMinutes(15);

            // Update the existing record with the new code and expiration
            DB::table('email_verifications')
                ->where('email', $request->email)
                ->update([
                    'token' => $newVerificationCode,
                    'expires_at' => $newExpiresAt,
                    'updated_at' => Carbon::now(), // Update the timestamp
                ]);

            // Send the email with the new verification code
            Mail::to($request->email)->send(new EmailVerificationMail($newVerificationCode));

            // Redirect back with a success message
            return redirect()->back()
                ->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.')
                ->withInput(['email' => $request->email]); // Keep email pre-filled

        } catch (\Exception $e) {
            Log::error('Resend verification code failed: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['email' => 'Terjadi kesalahan saat mengirim ulang kode. Silakan coba lagi.'])
                ->withInput(['email' => $request->email]);
        }
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
                    'PHONE_NUMBER' => NULL,
                    'IS_DELETED' => 0,
                ]);
            }

            Auth::login($user, true);

            return redirect()->intended('/user/homepage');
        } catch (\Exception $e) {
            Log::error('Google login failed: ' . $e->getMessage());
            return redirect()->route('auth.show')->withErrors(['email' => 'Google login failed. Silakan coba lagi.'], 'login')->with('active_panel', 'login');
        }
    }
}
