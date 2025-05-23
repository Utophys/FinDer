<?php

namespace App\Http\Controllers;

use App\Models\Variety;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Food;
use App\Models\AlternativeFish;
use App\Models\Criteria;
use App\Models\Results;
use App\Models\MasterAlternative;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function fishIndex()
    {
        $fishes = AlternativeFish::all();
        $criterias = Criteria::all();
        $foods = Food::all();

        return view('admin.fishes.index', compact('fishes', 'criterias', 'foods'));
    }

    public function foodIndex()
    {
        $foods = Food::all();

        return view('admin.foods.index', compact('foods'));
    }

    public function resultIndex()
    {
        $results = Results::with(['details', 'masterCriteria'])->get();

        return view('admin.user-results.index', compact('results'));
    }

    public function varietyIndex()
    {
        $varieties = Variety::all()->groupBy('FISH_ID');
        $fishes = AlternativeFish::all();

        return view('admin.varieties.index', compact('varieties', 'fishes'));
    }


    // ====== FOOD CRUD ======

    public function storeFood(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IMAGE' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'NAME' => 'required',
            'DESCRIPTION' => 'nullable',
            // jika ada relasi kategori makanan bisa ditambahkan validasi seperti 'FOOD_CATEGORY_ID' => 'exists:food_categories,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('IMAGE')) {
            $image = $request->file('IMAGE');
            $image->storeAs('foods', $image->hashName(), 'public');
            $imageName = $image->hashName();
        }

        Food::create([
            'FOOD_ID' => (string) Str::uuid(),
            'NAME' => $request->NAME,
            'DESCRIPTION' => $request->DESCRIPTION,
            'IMAGE' => $imageName,
            // tambahkan kolom lain jika ada
        ]);

        return redirect()->route('admin.foods.index')->with('success', 'Makanan berhasil ditambahkan');
    }

    public function updateFood(Request $request, $id)
    {
        $request->validate([
            'NAME' => 'required|string|max:255',
            'DESCRIPTION' => 'nullable|string',
            'IMAGE' => 'nullable|image|max:2048', // max 2MB
        ]);

        $food = Food::findOrFail($id);

        // Jika ada file gambar baru, upload dan update path
        if ($request->hasFile('IMAGE')) {
            // Hapus gambar lama jika ada
            if ($food->IMAGE && Storage::disk('public')->exists('foods/' . $food->IMAGE)) {
                Storage::disk('public')->delete('foods/' . $food->IMAGE);
            }

            // Simpan file baru
            $image = $request->file('IMAGE');
            $image->storeAs('foods', $image->hashName(), 'public');
            $food->IMAGE = $image->hashName();
        }

        // Update nama dan deskripsi
        $food->NAME = $request->NAME;
        $food->DESCRIPTION = $request->DESCRIPTION;

        $food->save();

        return redirect()->route('admin.foods.index')->with('success', 'Data makanan berhasil diperbarui.');
    }

    public function softDeleteFood($id)
    {
        $food = Food::findOrFail($id);
        $food->is_deleted = 1;
        $food->save();

        return redirect()->route('admin.foods.index');
    }

    public function recoverFood($id)
    {
        $food = Food::findOrFail($id);
        $food->is_deleted = 0;
        $food->save();

        return redirect()->route('admin.foods.index');
    }

    // ====== IKAN CRUD ======

    public function storeIkan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IMAGE' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'NAME' => 'required',
            'DESCRIPTION' => 'nullable',
            'FOOD_ID' => 'required|exists:FOOD,FOOD_ID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan file gambar
        $image = $request->file('IMAGE');
        $image->storeAs('alternative_fishes', $image->hashName(), 'public');

        // Simpan data ikan
        AlternativeFish::create([
            'FISH_ID' => (string) Str::uuid(),
            'NAME' => $request->NAME,
            'DESCRIPTION' => $request->DESCRIPTION,
            'IMAGE' => $image->hashName(),
            'FOOD_ID' => $request->FOOD_ID,
            'IS_DELETED' => 0,
        ]);

        return redirect()->route('admin.fishes.index')->with('success', 'Ikan berhasil ditambahkan');
    }

    public function updateIkan(Request $request, $id)
    {
        $request->validate([
            'NAME' => 'required|string',
            'DESCRIPTION' => 'nullable|string',
            'FOOD_ID' => 'required|exists:FOOD,FOOD_ID',
            'IMAGE' => 'nullable|image|max:2048', // max 2MB
        ]);

        $fish = AlternativeFish::findOrFail($id);

        // Jika ada file gambar baru, upload dan update path
        if ($request->hasFile('IMAGE')) {
            // Hapus gambar lama jika ada
            if ($fish->IMAGE && Storage::disk('public')->exists('alternative_fishes/' . $fish->IMAGE)) {
                Storage::disk('public')->delete('alternative_fishes/' . $fish->IMAGE);
            }

            // Simpan file baru
            $image = $request->file('IMAGE');
            $image->storeAs('alternative_fishes', $image->hashName(), 'public');
            $fish->IMAGE = $image->hashName();
        }

        $fish->NAME = $request->NAME;
        $fish->DESCRIPTION = $request->DESCRIPTION;
        $fish->FOOD_ID = $request->FOOD_ID;

        $fish->save();

        return redirect()->route('admin.fishes.index')->with('success', 'Data ikan berhasil diperbarui.');
    }

    public function softDeleteIkan($id)
    {
        $fish = AlternativeFish::findOrFail($id);
        $fish->is_deleted = 1;
        $fish->save();

        return redirect()->route('admin.fishes.index');
    }

    public function recoverIkan($id)
    {
        $ikan = AlternativeFish::findOrFail($id);
        $ikan->is_deleted = 0;
        $ikan->save();

        return redirect()->route('admin.fishes.index');
    }

    public function verifyIkan(Request $request, $fishId)
    {
        // Validasi data

        $request->validate([
            'criteria' => 'required|array',
            'criteria.*' => 'required|string',
        ]);

        // Cari ikan
        $ikan = AlternativeFish::findOrFail($fishId);

        foreach ($request->criteria as $criteriaId => $value) {
            if (empty($criteriaId) || !Criteria::where('CRITERIA_ID', $criteriaId)->exists()) {
                \Log::warning("Invalid CRITERIA_ID: $criteriaId");
                continue;
            }

            MasterAlternative::updateOrCreate(
                [
                    'FISH_ID' => $fishId,
                    'CRITERIA_ID' => $criteriaId,
                ],
                [
                    'VALUE' => $value,
                ]
            );
        }


        // Setelah semua tersimpan, update status verifikasi ikan
        $ikan->IS_VERIFIED = 1;
        $ikan->save();

        return redirect()->route('admin.fishes.index')->with('success', 'Ikan berhasil diverifikasi.');
    }



    public function storeVariety(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IMAGE' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'VARIETY_NAME' => 'required',
            'DESCRIPTION' => 'nullable',
            'FISH_ID' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan file gambar
        $image = $request->file('IMAGE');
        $image->storeAs('fish_varieties', $image->hashName(), 'public');

        // Simpan data ikan
        Variety::create([
            'FISH_VARIETY_ID' => (string) Str::uuid(),
            'VARIETY_NAME' => $request->VARIETY_NAME,
            'DESCRIPTION' => $request->DESCRIPTION,
            'IMAGE' => $image->hashName(),
            'FISH_ID' => $request->FISH_ID,
            'IS_DELETED' => 0,
        ]);

        return redirect()->route('admin.varieties.index')->with('success', 'Variasi ikan berhasil ditambahkan');
    }

    public function updateVariety(Request $request, $id)
    {
        $request->validate([
            'IMAGE' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'VARIETY_NAME' => 'required',
            'DESCRIPTION' => 'nullable',
            'FISH_ID' => 'required',
        ]);

        $variety = Variety::findOrFail($id); // Gunakan model Variety

        // Jika ada file gambar baru
        if ($request->hasFile('IMAGE')) {
            // Hapus gambar lama jika ada
            if ($variety->IMAGE && Storage::disk('public')->exists('fish_varieties/' . $variety->IMAGE)) {
                Storage::disk('public')->delete('fish_varieties/' . $variety->IMAGE);
            }

            // Simpan gambar baru
            $image = $request->file('IMAGE');
            $image->storeAs('fish_varieties', $image->hashName(), 'public');
            $variety->IMAGE = $image->hashName();
        }

        // Update data lainnya
        $variety->VARIETY_NAME = $request->VARIETY_NAME;
        $variety->DESCRIPTION = $request->DESCRIPTION;
        $variety->FISH_ID = $request->FISH_ID;

        $variety->save();

        return redirect()->route('admin.varieties.index')->with('success', 'Variasi ikan berhasil diperbarui.');
    }


    public function softDeleteVariety($id)
    {
        $variety = Variety::findOrFail($id);
        $variety->is_deleted = 1;
        $variety->save();

        return redirect()->route('admin.varieties.index');
    }

    public function recoverVariety($id)
    {
        $variety = Variety::findOrFail($id);
        $variety->is_deleted = 0;
        $variety->save();

        return redirect()->route('admin.varieties.index');
    }






}
