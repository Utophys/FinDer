@extends('layouts.admin.app')

@section('content')
    <div class="mt-10 px-4">
        <div class="flex justify-between items-center mb-6 px-18">
            <h1 class="font-bold">Data Varietas Ikan</h1>
            <button class="bg-white text-[#0E87CC] px-4 py-2 rounded hover:bg-gray-200 transition" data-bs-toggle="modal"
                data-bs-target="#createVarietyModal">+ Tambah Varietas Ikan</button>
        </div>

        <div class="flex flex-wrap gap-6">
            @foreach($varieties as $fishId => $varietyGroup)
                <div class="bg-white shadow rounded-lg p-4 w-full">
                    <h3 class="text-xl font-bold mb-4 text-black">
                        Varietas Ikan: {{ $fishes->firstWhere('FISH_ID', $fishId)?->NAME ?? 'Tidak diketahui' }}
                    </h3>
                    <div class="flex flex-wrap gap-4">
                        @foreach($varietyGroup as $variety)
                                <div
                                    class="w-64 rounded-lg shadow p-4
                                                                                        {{ $variety['IS_DELETED'] == 1 ? 'bg-red-500 text-white' : 'bg-gray-50' }}">

                                    <h4 class="text-lg font-semibold text-black">{{ $variety['VARIETY_NAME'] }}</h4>

                                    <div class="my-3">
                                        @if(!empty($variety['IMAGE']))
                                            <img src="{{ url($variety['IMAGE']) }}" class="w-full h-40 object-cover rounded"
                                                alt="food image">
                                        @else
                                            <p
                                                class="italic text-sm text-gray-500 {{ $variety['IS_DELETED'] == 1 ? 'text-white/80' : '' }}">
                                                Tidak ada gambar
                                            </p>
                                        @endif
                                    </div>

                                    <p class="text-sm text-black"><strong>ID:</strong> {{ $variety['FISH_VARIETY_ID'] }}</p>
                                    <p class="text-sm text-black"><strong>Deskripsi:</strong> {{ $variety['DESCRIPTION'] }}</p>
                                    <p class="text-sm text-black"><strong>Status:</strong> {{ $variety['IS_DELETED'] }}</p>

                                    <div class="flex justify-between mt-2">
                                        <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600"
                                            data-bs-toggle="modal" data-bs-target="#editVarietyModal{{ $variety->FISH_VARIETY_ID }}">
                                            Edit
                                        </button>

                                        <form action="{{ $variety['IS_DELETED'] == 1
                            ? route('admin.varieties.recover', $variety->FISH_VARIETY_ID)
                            : route('admin.varieties.softDelete', $variety->FISH_VARIETY_ID) }}" method="POST"
                                            onsubmit="return confirm('{{ $variety['IS_DELETED'] == 1 ? 'Pulihkan data ini?' : 'Hapus data makanan ini?' }}')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="{{ $variety['IS_DELETED'] == 1
                            ? 'bg-green-600 hover:bg-green-700'
                            : 'bg-red-600 hover:bg-red-700' }} text-white px-3 py-1 rounded text-sm">
                                                {{ $variety['IS_DELETED'] == 1 ? 'Recover' : 'Delete' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editVarietyModal{{ $variety->FISH_VARIETY_ID }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('admin.varieties.update', $variety->FISH_VARIETY_ID) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Variasi Ikan: {{ $variety->VARIETY_NAME }}</h5>
                                                </div>
                                                <div class="modal-body text-black">
                                                    <div class="mb-3">
                                                        <label for="FISH_ID{{ $variety->FISH_VARIETY_ID }}"
                                                            class="block text-gray-700 font-semibold mb-2">Pilih Ikan</label>
                                                        <select name="FISH_ID" id="FISH_ID{{ $variety->FISH_VARIETY_ID }}"
                                                            class="form-control">
                                                            <option value="">-- Pilih Ikan --</option>
                                                            @foreach($fishes as $fish)
                                                                <option value="{{ $fish->FISH_ID }}" {{ $variety->FISH_ID == $fish->FISH_ID ? 'selected' : '' }}>
                                                                    {{ $fish->NAME }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="VARIETY_NAME{{ $variety->FISH_VARIETY_ID }}"
                                                            class="block text-gray-700 font-semibold mb-2">Nama Variasi</label>
                                                        <input type="text" name="VARIETY_NAME"
                                                            id="VARIETY_NAME{{ $variety->FISH_VARIETY_ID }}" class="form-control"
                                                            value="{{ old('VARIETY_NAME', $variety->VARIETY_NAME) }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="IMAGE{{ $variety->FISH_VARIETY_ID }}"
                                                            class="block text-gray-700 font-semibold mb-2">Gambar</label>
                                                        <input type="file" name="IMAGE" id="IMAGE{{ $variety->FISH_VARIETY_ID }}"
                                                            class="form-control" accept="image/*">
                                                        @if(!empty($variety->IMAGE))
                                                            <img src="{{ asset('storage/fish_varieties/' . $variety->IMAGE) }}"
                                                                class="w-full h-40 object-cover rounded mt-2" alt="variety image">
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="DESCRIPTION{{ $variety->FISH_VARIETY_ID }}"
                                                            class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                                                        <textarea name="DESCRIPTION" id="DESCRIPTION{{ $variety->FISH_VARIETY_ID }}"
                                                            class="form-control" rows="3"
                                                            placeholder="Deskripsi...">{{ old('DESCRIPTION', $variety->DESCRIPTION) }}</textarea>
                                                    </div>
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
            @endforeach
        </div>

    </div>
    </div>

    <div class="modal fade" id="createVarietyModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.varieties.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Variasi Ikan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-black">
                        <div class="mb-3">
                            <label for="FISH_ID" class="block text-gray-700 font-semibold mb-2">Pilih Ikan</label>
                            <select name="FISH_ID" id="FISH_ID" class="form-control">
                                <option value="">-- Pilih Ikan --</option>
                                @foreach($fishes as $fish)
                                    <option value="{{ $fish->FISH_ID }}">{{ $fish->NAME }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="VARIETY_NAME" class="block text-gray-700 font-semibold mb-2">Nama Variasi</label>
                            <input type="text" name="VARIETY_NAME" id="VARIETY_NAME" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="IMAGE" class="block text-gray-700 font-semibold mb-2">Gambar</label>
                            <input type="file" name="IMAGE" id="IMAGE" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="DESCRIPTION" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                            <textarea name="DESCRIPTION" id="DESCRIPTION" class="form-control" rows="3"
                                placeholder="Deskripsi..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', () => {
    // --- Validasi Create Modal ---
    const createForm = document.querySelector('#createVarietyModal form');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            let errors = [];

            const fishId = this.querySelector('select[name="FISH_ID"]').value.trim();
            const varietyName = this.querySelector('input[name="VARIETY_NAME"]').value.trim();
            const imageInput = this.querySelector('input[name="IMAGE"]');
            const description = this.querySelector('textarea[name="DESCRIPTION"]').value.trim();

            // Validate Fish ID
            if (!fishId) {
                errors.push("Pilih ikan wajib diisi.");
            }

            // Validate Variety Name
            if (!varietyName) {
                errors.push("Nama variasi wajib diisi.");
            } else if (varietyName.length > 255) {
                errors.push("Nama variasi maksimal 255 karakter.");
            }


            if (!imageInput.files || imageInput.files.length === 0) {
                errors.push("Gambar wajib diupload.");
            } else {
                const file = imageInput.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
                if (!validTypes.includes(file.type)) {
                    errors.push("Tipe file gambar tidak valid. Harus jpeg, png, jpg, gif, atau svg.");
                }
                if (file.size > 2 * 1024 * 1024) {
                    errors.push("Ukuran file gambar maksimal 2MB.");
                }
            }

            // Validate Description (optional, max 1000 chars)
            if (description.length > 1000) {
                errors.push("Deskripsi maksimal 1000 karakter.");
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join('\n'));
            }
        });
    }

    // --- Validasi Edit Modals ---
    // Karena ada banyak modal edit, kita loop semua form di modal edit
    document.querySelectorAll('form[action*="admin.varieties.update"]').forEach(editForm => {
        editForm.addEventListener('submit', function(e) {
            let errors = [];

            const fishId = this.querySelector('select[name="FISH_ID"]').value.trim();
            const varietyName = this.querySelector('input[name="VARIETY_NAME"]').value.trim();
            const imageInput = this.querySelector('input[name="IMAGE"]');
            const description = this.querySelector('textarea[name="DESCRIPTION"]').value.trim();

            // Validate Fish ID
            if (!fishId) {
                errors.push("Pilih ikan wajib diisi.");
            }

            // Validate Variety Name
            if (!varietyName) {
                errors.push("Nama variasi wajib diisi.");
            } else if (varietyName.length > 255) {
                errors.push("Nama variasi maksimal 255 karakter.");
            }

            // Validate Image (optional, if ada file dicek tipe dan size)
            if (imageInput.files && imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
                if (!validTypes.includes(file.type)) {
                    errors.push("Tipe file gambar tidak valid. Harus jpeg, png, jpg, gif, atau svg.");
                }
                if (file.size > 2 * 1024 * 1024) {
                    errors.push("Ukuran file gambar maksimal 2MB.");
                }
            }

            // Validate Description (optional, max 1000 chars)
            if (description.length > 1000) {
                errors.push("Deskripsi maksimal 1000 karakter.");
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join('\n'));
            }
        });
    });
});
</script>


@endsection
