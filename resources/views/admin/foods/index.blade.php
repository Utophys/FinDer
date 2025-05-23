@extends('layouts.admin.app')

@section('content')
            <div class="mt-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Data Makanan</h2>
                    <button class="bg-white text-[#0E87CC] px-4 py-2 rounded hover:bg-gray-200 transition"
                        data-bs-toggle="modal" data-bs-target="#createFoodModal">+ Tambah Makanan</button>
                </div>

                <div class="flex flex-wrap gap-6">
                    @foreach($foods as $food)
                                <div
                                    class="text-gray-800 w-64 rounded-lg shadow p-4 
                                                                                                                                                                                                                                                                    {{ $food['IS_DELETED'] == 1 ? 'bg-red-500 text-white' : 'bg-white' }}">
                                    <h3 class="text-lg font-semibold">{{ $food['NAME'] }}</h3>
                                    <div class="my-3">
                                        @if(!empty($food['IMAGE']))
                                            <img src="{{ url($food['IMAGE']) }}" class="w-full h-40 object-cover rounded" alt="fish image">
                                        @else
                                            <p class="italic text-sm text-gray-500 {{ $food['IS_DELETED'] == 1 ? 'text-white/80' : '' }}">
                                                Tidak ada gambar
                                            </p>
                                        @endif
                                    </div>
                                    <p class="text-sm"><strong>ID:</strong> {{ $food['FOOD_ID'] }}</p>
                                    <p class="text-sm"><strong>Deskripsi:</strong> {{ $food['DESCRIPTION'] }}</p>
                                    <p class="text-sm"><strong>Status:</strong> {{ $food['IS_DELETED'] }}</p>

                                    
                                    <div class="flex justify-between">
                                        <!-- Edit button -->
                                        <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600"
                                            data-bs-toggle="modal" data-bs-target="#editFoodModal{{ $food->FOOD_ID }}">
                                            Edit
                                        </button>

                                        <!-- Delete/Recover form -->
                                        <form action="{{ $food['IS_DELETED'] == 1
                        ? route('admin.food.recover', $food->FOOD_ID)
                        : route('admin.food.softDelete', $food->FOOD_ID) }}" method="POST"
                                            onsubmit="return confirm('{{ $food['IS_DELETED'] == 1 ? 'Pulihkan data ini?' : 'Hapus data makanan ini?' }}')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="{{ $food['IS_DELETED'] == 1
                        ? 'bg-green-600 hover:bg-green-700'
                        : 'bg-red-600 hover:bg-red-700' }} text-white px-3 py-1 rounded text-sm">
                                                {{ $food['IS_DELETED'] == 1 ? 'Recover' : 'Delete' }}
                                            </button>
                                        </form>

                                    </div>
                                </div>

                                <div class="modal fade" id="editFoodModal{{ $food->FOOD_ID }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('admin.food.update', $food->FOOD_ID) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Makanan: {{ $food->NAME }}</h5>
                                                </div>
                                                <div class="modal-body text-black">
                                                    <input type="text" name="NAME" class="form-control mt-2" placeholder="Nama" required value="{{ old('NAME', $food->NAME) }}">
                                                    <div class="mb-4 mt-2">
                                                        <label class="block text-gray-700 font-semibold mb-2" for="imageEditFood{{ $food->FOOD_ID }}">Gambar Makanan (kosongkan jika tidak ingin ganti)</label>
                                                        <input type="file" id="imageEditFood{{ $food->FOOD_ID }}" name="IMAGE" accept="image/*" class="w-full p-2 border rounded">
                                                        @if(!empty($food->IMAGE))
                                                            <img src="{{ url($food->IMAGE) }}" class="w-full h-40 object-cover rounded mt-2" alt="food image">
                                                        @endif
                                                    </div>
                                                    <textarea name="DESCRIPTION" class="form-control mt-2" placeholder="Deskripsi">{{ old('DESCRIPTION', $food->DESCRIPTION) }}</textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

<div class="modal fade" id="createFoodModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.food.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Makanan Baru</h5>
                </div>
                <div class="modal-body text-black">
                    <input type="text" name="NAME" class="form-control mt-2" placeholder="Nama" required>

                    <div class="mb-4 mt-2">
                        <label class="block text-gray-700 font-semibold mb-2" for="imageFood">Gambar Makanan</label>
                        <input type="file" id="imageFood" name="IMAGE" accept="image/*" class="w-full p-2 border rounded" required>
                    </div>

                    <textarea name="DESCRIPTION" class="form-control mt-2" placeholder="Deskripsi"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


<!-- 


@extends('layouts.admin.app')

@section('content')
    <div class="mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Data Makanan</h2>
            <button onclick="openModal('createFoodModal')"
                class="bg-white text-[#0E87CC] px-4 py-2 rounded hover:bg-gray-200 transition">+ Tambah Makanan</button>
        </div>

        <div class="flex flex-wrap gap-6">
            @foreach($foods as $food)
                <div
                    class="text-gray-800 w-64 rounded-lg shadow p-4 {{ $food['IS_DELETED'] == 1 ? 'bg-red-500 text-white' : 'bg-white' }}">
                    <h3 class="text-lg font-semibold">{{ $food['NAME'] }}</h3>
                    <div class="my-3">
                        @if(!empty($food['IMAGE']))
                            <img src="{{ url($food['IMAGE']) }}" class="w-full h-40 object-cover rounded" alt="food image">
                        @else
                            <p class="italic text-sm text-gray-500 {{ $food['IS_DELETED'] == 1 ? 'text-white/80' : '' }}">
                                Tidak ada gambar
                            </p>
                        @endif
                    </div>
                    <p class="text-sm"><strong>ID:</strong> {{ $food['FOOD_ID'] }}</p>
                    <p class="text-sm"><strong>Deskripsi:</strong> {{ $food['DESCRIPTION'] }}</p>
                    <p class="text-sm"><strong>Status:</strong> {{ $food['IS_DELETED'] }}</p>

                    <div class="flex justify-between">
                        <button onclick="openModal('editFoodModal{{ $food->FOOD_ID }}')"
                            class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Edit</button>

                        <form action="{{ $food['IS_DELETED'] == 1
                ? route('admin.food.recover', $food->FOOD_ID)
                : route('admin.food.softDelete', $food->FOOD_ID) }}" method="POST"
                            onsubmit="return confirm('{{ $food['IS_DELETED'] == 1 ? 'Pulihkan data ini?' : 'Hapus data makanan ini?' }}')">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="{{ $food['IS_DELETED'] == 1 ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} text-white px-3 py-1 rounded text-sm">
                                {{ $food['IS_DELETED'] == 1 ? 'Recover' : 'Delete' }}
                            </button>
                        </form>
                    </div>
                </div>


                <div id="editFoodModal{{ $food->FOOD_ID }}"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg w-full max-w-md p-6 text-black">
                        <h2 class="text-xl font-bold mb-4">Edit Makanan: {{ $food->NAME }}</h2>
                        <form method="POST" action="{{ route('admin.food.update', $food->FOOD_ID) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="text" name="NAME" class="w-full p-2 border rounded mt-2" required
                                value="{{ old('NAME', $food->NAME) }}">
                            <div class="mt-4">
                                <label class="block text-gray-700 mb-2">Gambar Makanan</label>
                                <input type="file" name="IMAGE" accept="image/*" class="w-full p-2 border rounded">
                                @if(!empty($food->IMAGE))
                                    <img src="{{ url($food->IMAGE) }}" class="w-full h-40 object-cover rounded mt-2" alt="image">
                                @endif
                            </div>
                            <textarea name="DESCRIPTION" class="w-full p-2 border rounded mt-4"
                                placeholder="Deskripsi">{{ old('DESCRIPTION', $food->DESCRIPTION) }}</textarea>
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="button" onclick="closeModal('editFoodModal{{ $food->FOOD_ID }}')"
                                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div id="createFoodModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6 text-black">
            <h2 class="text-xl font-bold mb-4">Tambah Makanan Baru</h2>
            <form method="POST" action="{{ route('admin.food.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" name="NAME" class="w-full p-2 border rounded mt-2" placeholder="Nama" required>
                <div class="mt-4">
                    <label class="block text-gray-700 mb-2">Gambar Makanan</label>
                    <input type="file" name="IMAGE" accept="image/*" class="w-full p-2 border rounded" required>
                </div>
                <textarea name="DESCRIPTION" class="w-full p-2 border rounded mt-4" placeholder="Deskripsi"></textarea>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeModal('createFoodModal')"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.remove('hidden');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) modal.classList.add('hidden');
        }

        // Optional: klik di luar modal untuk menutup
        document.addEventListener('click', function (e) {
            const modals = document.querySelectorAll('[id^="editFoodModal"], #createFoodModal');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden') && e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection -->