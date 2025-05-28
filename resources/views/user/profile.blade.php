@extends('layouts.app')

@section('content')

<!-- Include Header -->
@include('partials.header')

<!-- Tambahkan mt-[80px] untuk memberi jarak dari header -->
<div class="flex flex-col md:flex-row mt-[80px] min-h-[calc(100vh-80px)]">
    <!-- Sidebar Kiri -->
    <div class="md:w-1/3 w-full bg-gray-200 p-6 flex flex-col items-center justify-center">
        <!-- Icon User -->
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-24 h-24 text-gray-700">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975
                         m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0
                         0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
        </div>
        <h2 class="text-xl font-semibold mb-4">Ask D. Question</h2>
        <!-- Button Edit -->
        <button onclick="toggleModal('editModal')"
                class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-[#0E87CC] text-white rounded-full hover:bg-[#0C76B3] transition">
            Edit Profil
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-5 h-5" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5
                         4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931Z"/>
            </svg>
        </button>
    </div>

    <!-- Konten Kanan -->
    <div class="md:w-2/3 w-full bg-gradient-to-r from-blue-600 to-[#0E87CC] text-white p-6">
        <div class="flex items-center space-x-3 mb-6 pt-8">
            <img src="{{ asset('assets/images/history-white-icon.svg') }}" class="w-7 h-7" alt="History">
            <h2 class="text-2xl font-bold animate__animated animate__fadeInDown">Histori SPK Pengguna</h2>
        </div>

        <!-- Card Log Aktivitas -->
        @foreach(range(1,2) as $log)
            <div class="bg-white text-black p-4 mb-4 rounded-lg shadow-md cursor-pointer transition hover:shadow-lg"
                 onclick="toggleDetail(this)">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-lg">Username</h3>
                        <p class="text-sm text-gray-600">28 - 5 - 2025 (12.45.13)</p>
                    </div>
                    <!-- Ikon Dropdown -->
                    <div class="icon text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 icon-toggle" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </div>
                </div>
                <!-- Detail disembunyikan -->
                <div class="detail mt-2 hidden">
                    <ul class="list-disc ml-5 text-sm text-gray-700">
                        <li>Ikan: f22... - Rank: 17</li>
                        <li>Weight Text: Sangat Penting - Weight Int: 4</li>
                        <li>Weight Text: Tidak Penting - Weight Int: 1</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal Edit Profile -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 justify-center items-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md animate__animated animate__zoomIn">
        <h2 class="text-xl font-bold mb-4">Edit Profile</h2>
        <form>
            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Upload Foto</label>
                <input type="file" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-gray-700">Nama</label>
                <input type="text" value="Ask D. Question"
                       class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                        onclick="toggleModal('editModal')">Batal</button>
                <button type="submit"
                        class="px-4 py-2 bg-[#0E87CC] text-white rounded hover:bg-[#0C76B3]">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleDetail(card) {
        const detail = card.querySelector('.detail');
        const icon = card.querySelector('.icon-toggle');

        detail.classList.toggle('hidden');

        if (!detail.classList.contains('hidden')) {
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`;
        } else {
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
        }
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
</script>

@endsection
