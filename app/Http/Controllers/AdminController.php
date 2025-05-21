<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Food;
use App\Models\AlternativeFish;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        $fishes = AlternativeFish::all();

        return view('admin.index', compact('foods', 'fishes'));
    }

    // ====== FOOD CRUD ======

    public function storeFood(Request $request)
    {
        $request->validate([
            'NAME' => 'required',
            'DESCRIPTION' => 'nullable',
            'IMAGE' => 'nullable',
        ]);

        Food::create($request->all());

        return redirect()->route('admin.index');
    }

    public function editFood($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.edit_food', compact('food'));
    }

    public function updateFood(Request $request, $id)
    {
        $request->validate([
            'NAME' => 'required',
            'DESCRIPTION' => 'nullable',
            'IMAGE' => 'nullable',
        ]);

        $food = Food::findOrFail($id);
        $food->update($request->all());

        return redirect()->route('admin.index');
    }

    public function deleteFood($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->route('admin.index');
    }

    public function softDeleteFood($id)
    {
        $food = Food::findOrFail($id);
        $food->is_deleted = 1;
        $food->save();

        return redirect()->route('admin.index');
    }

    public function recoverFood($id)
    {
        $food = Food::findOrFail($id);
        $food->is_deleted = 0;
        $food->save();

        return redirect()->route('admin.index');
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

        return redirect()->route('admin.index')->with('success', 'Ikan berhasil ditambahkan');
    }
    public function editIkan($id)
    {
        $fish = AlternativeFish::findOrFail($id);
        $foods = Food::all();
        return view('admin.edit_ikan', compact('fish', 'foods'));
    }

    public function updateIkan(Request $request, $id)
    {
        $request->validate([
            'NAME' => 'required',
            'DESCRIPTION' => 'nullable',
            'FOOD_ID' => 'required|exists:FOOD,FOOD_ID',
            'IMAGE' => 'nullable',
        ]);

        $fish = AlternativeFish::findOrFail($id);
        $fish->update($request->all());

        return redirect()->route('admin.index');
    }

    public function deleteIkan($id)
    {
        $fish = AlternativeFish::findOrFail($id);
        $fish->delete();

        return redirect()->route('admin.index');
    }
    public function softDeleteIkan($id)
    {
        $fish = AlternativeFish::findOrFail($id);
        $fish->is_deleted = 1;
        $fish->save();

        return redirect()->route('admin.index');
    }

    public function recoverIkan($id)
    {
        $ikan = AlternativeFish::findOrFail($id);
        $ikan->is_deleted = 0;
        $ikan->save();

        return redirect()->route('admin.index');
    }

}
