<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function sendCustomResetLink(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->EMAIL) {
            return back()->withErrors(['email' => 'No email found for the user.']);
        }

        $token = Password::createToken($user);

        $resetLink = url('reset-password/' . $token) . '?email=' . urlencode($user->EMAIL);

        Mail::to($user->EMAIL)->send(new SendEmail([
            'name' => $user->DISPLAY_NAME,
            'body' => 'Klik tautan berikut untuk mengatur ulang kata sandi Anda: ' . $resetLink,
        ]));

        return back()->with('status', 'Periksa Email Anda!');
        
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email')
        ]);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->password = Hash::make($password);

                $user->SET_PASSWORD = 1;

                $user->save();

                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('homepage')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
