<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    public function create()
    {
        return view('admin.createFoodCategory');
    }


    public function store(Request $request)
    {
        $restaurantType = new FoodCategory();
        $restaurantType->title = $request->title;
        $restaurantType->save();

        return redirect()->route('dashboard');
    }


    public function edit(string $id)
    {
        return view('admin.editFoodCategory', compact('id'));
    }


    public function update(Request $request)
    {
        $type = FoodCategory::find($request->id);
        $type->title = $request->title;
        $type->save();

        return redirect()->route('dashboard');
    }

    
    public function destroy(Request $request)
    {
        FoodCategory::destroy($request->id);
        return redirect()->route('dashboard');
    }
}
