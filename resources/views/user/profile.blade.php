@extends('layouts.app')

@section('content')

@include('partials.header')

<div class="flex flex-col md:flex-row mt-[80px]" style="min-height: calc(100vh - 80px)">

    <div class="md:w-1/3 w-full bg-gray-200 p-6 flex flex-col items-center justify-center"
        style="height: calc(100vh - 80px); flex-shrink: 0;">
        <div class="mb-4">
            @if ($user->IMAGE)
            <img src="{{ asset('storage/user/' . Auth::user()->IMAGE) }}" alt="User Image"
                class="w-40 h-40 rounded-full object-cover">
            @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-40 h-40 text-gray-700 rounded-full">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975
             m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0
             0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            @endif
        </div>



        <h2 class="text-xl font-semibold mb-4">{{ $user->DISPLAY_NAME }}</h2>

        <button onclick="toggleModal('editModal')"
            class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-[#0E87CC] text-white rounded-full hover:bg-[#0C76B3] transition">
            Edit Profil
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5
                         4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931Z" />
            </svg>
        </button>
    </div>

    <div class="md:w-2/3 w-full bg-gradient-to-r from-blue-600 to-[#0E87CC] text-white p-6 overflow-y-auto"
        style="height: calc(100vh - 80px);">
        <div class="flex items-center space-x-3 mb-6 pt-8">
            <img src="{{ asset('assets/images/history-white-icon.svg') }}" class="w-7 h-7" alt="History">
            <h2 class="text-2xl font-bold animate__animated animate__fadeInDown">Histori SPK Pengguna</h2>
        </div>

        @if(isset($resultsWithDetails) && count($resultsWithDetails) > 0)
        @foreach ($resultsWithDetails as $entry)
        @php
        $topFish = $entry['details']->firstWhere('RANKING', 1);
        @endphp

        <div class="bg-white text-black p-4 mb-4 rounded-lg shadow-md cursor-pointer transition hover:shadow-lg" onclick="toggleDetail(this)">
            <div class="flex justify-between items-center mb-3">
                <div class="flex items-center">
                    @if ($topFish)
                    <img src="{{ asset('storage/alternative_fishes/' . $topFish->IMAGE) }}" alt="{{ $topFish->fish_name }}"
                        class="w-24 h-24 rounded-lg object-cover mr-4" />
                    <div>
                        <h2 class="text-xl font-bold mb-1">Ikan #1: {{ $topFish->fish_name }}</h2>
                    </div>
                    @endif
                </div>

                <div>
                    <a href="{{ route('user.dss.calculation', ['result_id' => $entry['result']->RESULT_ID]) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Lihat Perhitungan
                    </a>

                </div>
            </div>


            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($entry['result']->TIME_ADDED)->timezone('Asia/Jakarta')->format('d - m - Y (H.i.s)') }}</p>
                </div>
                <div class="icon text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 icon-toggle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </div>

            <div class="detail mt-2 hidden">
                @for ($rank = 2; $rank <= 5; $rank++)
                    @php
                    $fish=$entry['details']->firstWhere('RANKING', $rank);
                    @endphp
                    @if ($fish)
                    <div class="flex items-center mb-2">
                        <img src="{{ asset('storage/alternative_fishes/' . $fish->IMAGE) }}" alt="{{ $fish->fish_name }}" class="w-16 h-16 rounded-lg object-cover mr-4" />
                        <div>
                            <p class="font-semibold">Ikan #{{ $rank }}: {{ $fish->fish_name }}</p>
                        </div>
                    </div>
                    @endif
                    @endfor


                    @php
                    $questions = [
                    [
                    'id' => 1,
                    'dbCriteriaId' => 'CRT00001',
                    'text' => 'Seberapa besar pengaruh harga awal ikan terhadap keputusan Anda?',
                    'meta' => 'Pertanyaan 1/7 - Nilai/Harga',
                    ],
                    [
                    'id' => 2,
                    'dbCriteriaId' => 'CRT00002',
                    'text' => 'Memikirkan perawatan ikan, seberapa penting kemudahan dalam merawatnya?',
                    'meta' => 'Pertanyaan 2/7 - Kompleksitas Pemeliharaan',
                    ],
                    [
                    'id' => 3,
                    'dbCriteriaId' => 'CRT00003',
                    'text' => 'Bagaimana pertimbangan Anda terhadap biaya rutin pemeliharaan ikan?',
                    'meta' => 'Pertanyaan 3/7 - Biaya Pemeliharaan',
                    ],
                    [
                    'id' => 4,
                    'dbCriteriaId' => 'CRT00004',
                    'text' => 'Mengenai ukuran maksimal ikan dewasa, seberapa penting ini bagi Anda?',
                    'meta' => 'Pertanyaan 4/7 - Ukuran',
                    ],
                    [
                    'id' => 5,
                    'dbCriteriaId' => 'CRT00005',
                    'text' => 'Seberapa menarik bagi Anda untuk memiliki ikan yang langka atau unik?',
                    'meta' => 'Pertanyaan 5/7 - Kelangkaan',
                    ],
                    [
                    'id' => 6,
                    'dbCriteriaId' => 'CRT00006',
                    'text' => 'Seberapa besar peran keindahan visual ikan dalam pilihan Anda?',
                    'meta' => 'Pertanyaan 6/7 - Estetika',
                    ],
                    [
                    'id' => 7,
                    'dbCriteriaId' => 'CRT00007',
                    'text' => 'Seberapa penting karakter atau tingkah laku unik ikan bagi Anda?',
                    'meta' => 'Pertanyaan 7/7 - Perilaku',
                    ],
                    ];

                    $criteriaMap = [];
                    foreach ($entry['criteria'] as $crit) {
                    $criteriaMap[$crit->CRITERIA_ID] = $crit;
                    }
                    @endphp

                    <div class="mt-4">
                        <h3 class="font-semibold mb-2">Pertanyaan & Jawaban</h3>
                        <div class="space-y-4">
                            @foreach ($questions as $q)
                            @php
                            $answer = $criteriaMap[$q['dbCriteriaId']] ?? null;
                            @endphp
                            <div class="bg-gray-100 p-3 rounded shadow-sm">
                                <p class="text-sm font-medium text-gray-800">{{ $q['meta'] }}</p>
                                <p class="text-sm text-gray-700">{{ $q['text'] }}</p>
                                @if ($answer)
                                <p class="mt-1 font-semibold text-blue-700">
                                    Jawaban: {{ $answer->WEIGHT_TXT }} (Nilai: {{ $answer->WEIGHT_INT }})
                                </p>
                                @else
                                <p class="mt-1 italic text-gray-500">Belum ada jawaban.</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>


            </div>

        </div>

        @endforeach
        @else
        <p>No history found.</p>
        @endif
    </div>

</div>

<div id="editModal" class="fixed inset-0 bg-black/30 justify-center items-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-8 animate__animated animate__zoomIn relative">
        <h2 class="text-2xl font-semibold mb-6 text-center text-[#0E87CC]">Edit Profile</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label for="image" class="block mb-2 font-medium text-gray-700">Upload Foto</label>
                <input type="file" id="image" name="image" accept="image/*" class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0E87CC] focus:border-transparent" />
            </div>

            <div>
                <label for="display_name" class="block mb-2 font-medium text-gray-700">Nama</label>
                <input type="text" id="display_name" name="display_name" value="{{ old('display_name', Auth::user()->DISPLAY_NAME) }}" required
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0E87CC] focus:border-transparent" />
                @if ($errors->update->has('display_name'))
                <p class="mt-1 text-sm text-red-500">{{ $errors->update->first('display_name') }}</p>
                @endif
            </div>


            <label for="password" class="block mb-2 font-medium text-gray-700">Password Baru</label>
            <div class="relative">
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full rounded border border-gray-300 px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-[#0E87CC] focus:border-transparent" />
                <button
                    type="button"
                    onclick="togglePassword('password', this)"
                    aria-label="Toggle password visibility"
                    class="absolute right-2 top-1/2 -translate-y-1/2 flex items-center justify-center text-gray-500 hover:text-[#0E87CC] h-6 w-6">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        class="w-5 h-5">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <div>
                <label for="password_confirmation" class="block mb-2 font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0E87CC] focus:border-transparent" />
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="toggleModal('editModal')" class="px-5 py-2 rounded-md bg-gray-200 hover:bg-gray-300 transition">Batal</button>
                <button type="submit" class="px-6 py-2 rounded-md bg-[#0E87CC] text-white hover:bg-[#0b5e8a] transition">Simpan</button>
            </div>
        </form>

        <form action="{{ route('profile.delete') }}" method="POST" class="mt-6 text-center" onsubmit="return confirm('Anda yakin ingin menghapus akun?\n\nAnda harus menghubungi admin untuk mengaktifkan akun Anda kembali.')">
            @csrf
            <button type="submit" class="text-red-600 hover:underline font-semibold">Hapus Akun</button>
        </form>

        <button onclick="toggleModal('editModal')" aria-label="Close modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>


<script>
    function toggleDetail(card) {
        document.querySelectorAll('.detail').forEach(el => {
            if (el !== card.querySelector('.detail')) {
                el.classList.add('hidden');
                const icon = el.closest('.bg-white').querySelector('.icon-toggle');
                if (icon) {
                    icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
                }
            }
        });

        const detail = card.querySelector('.detail');
        const icon = card.querySelector('.icon-toggle');
        detail.classList.toggle('hidden');
        icon.innerHTML = detail.classList.contains('hidden') ?
            `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />` :
            `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`;
    }


    function toggleModal(id) {
        const modal = document.getElementById(id);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    }

    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.944-9.543-7a10.053 10.053 0 012.236-3.396m2.85-2.865A9.956 9.956 0 0112 5c4.478 0 8.27 2.944 9.543 7a9.965 9.965 0 01-4.1 5.38M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>`;
        } else {
            input.type = 'password';
            btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>`;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('active_panel') === 'edit' && $errors->update->any())
        toggleModal('editModal');
        @endif
    });
</script>

@endsection