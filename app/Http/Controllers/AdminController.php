<?php

namespace App\Http\Controllers;

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
    public function createFood()
    {
        return view('admin.create_food');
    }

    public function storeFood(Request $request)
    {
        $request->validate([
            'FOOD_ID' => 'required|unique:FOOD,FOOD_ID',
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

    // ====== IKAN CRUD ======
    public function createIkan()
    {
        $foods = Food::all();
        return view('admin.create_ikan', compact('foods'));
    }

    public function storeIkan(Request $request)
    {
        $request->validate([
            'FISH_ID' => 'required|unique:ALTERNATIVE_FISH,FISH_ID',
            'NAME' => 'required',
            'DESCRIPTION' => 'nullable',
            'FOOD_ID' => 'required|exists:FOOD,FOOD_ID',
        ]);

        AlternativeFish::create($request->all());

        return redirect()->route('admin.index');
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

}
