<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class HistoryController extends Controller
{

    public function showUserDSSHistory()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'User not authenticated.');
        }

        $decryptedPhoneNumber = '';
        if ($user->PHONE_NUMBER) {
            try {
                $decryptedPhoneNumber = Crypt::decryptString($user->PHONE_NUMBER);
            } catch (DecryptException $e) {
                $decryptedPhoneNumber = 'Invalid phone number data';
            }
        }

        $userId = (string) $user->USER_ID;

        $results = DB::table('result')
            ->where('USER_ID', $userId)
            ->orderBy('TIME_ADDED', 'desc')
            ->get();


        $resultsWithDetails = [];

        if (!$results->isEmpty()) {
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

                $resultsWithDetails[] = [
                    'result' => $result,
                    'details' => $details,
                    'criteria' => $criteria,
                ];
            }
        }
        
        return view('user.profile', compact('user', 'resultsWithDetails', 'decryptedPhoneNumber'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'display_name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9 ]+$/'],
            'phone_number' => ['nullable', 'string', 'max:20', 'regex:/^[0-9\s\-\(\)]+$/'], 
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/'
            ],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ], [
            'display_name.required' => 'Nama wajib diisi.',
            'display_name.regex' => 'Nama hanya boleh mengandung huruf, angka, dan spasi.',
            'phone_number.string' => 'Nomor telepon harus berupa teks.',
            'phone_number.max' => 'Nomor telepon maksimal :max karakter.',
            'phone_number.regex' => 'Nomor telepon hanya boleh mengandung angka, spasi, tanda kurung, dan tanda hubung.',
            'password.min' => 'Password minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'update')
                ->withInput()
                ->with('active_panel', 'edit');
        }

        $user->DISPLAY_NAME = $request->display_name;

        if ($request->filled('phone_number')) {
            $user->PHONE_NUMBER = Crypt::encryptString($request->phone_number);
        } else {
            $user->PHONE_NUMBER = NULL;
        }

        if ($request->hasFile('image')) {
            if ($user->IMAGE && Storage::disk('public')->exists('user/' . $user->IMAGE)) {
                Storage::disk('public')->delete('user/' . $user->IMAGE);
            }
            $image = $request->file('image');
            $filename = $image->hashName();
            $image->storeAs('user', $filename, 'public');
            $user->IMAGE = $filename;
        }


        if ($request->filled('password')) {
            $user->PASSWORD = Hash::make($request->password);
            $user->SET_PASSWORD = 1;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }


    public function deleteProfile(Request $request)
    {
        $user = Auth::user();
        $user->IS_DELETED = true;
        $user->save();

        Auth::logout();

        return redirect('/')->with('status', 'Account deleted.');
    }
}
