<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createFoodCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restaurantType = new FoodCategory();
        $restaurantType->title = $request->title;
        $restaurantType->save();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.editFoodCategory', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $type = FoodCategory::find($request->id);
        $type->title = $request->title;
        $type->save();

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        FoodCategory::destroy($request->id);
        return redirect()->route('dashboard');
    }
}
