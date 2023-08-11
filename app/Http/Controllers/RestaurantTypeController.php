<?php

namespace App\Http\Controllers;

use App\Models\RestaurantType;
use Illuminate\Http\Request;

class RestaurantTypeController extends Controller
{
    public function store(Request $request)
    {
        $restaurantType = new RestaurantType();
        $restaurantType->title = $request->title;
        $restaurantType->save();

        return redirect()->route('dashboard');
    }


    public function edit(string $id)
    {
        return view('admin.editRestaurantType', compact('id'));
    }


    public function update(Request $request)
    {
        $type = RestaurantType::find($request->id);
        $type->title = $request->title;
        $type->save();

        return redirect()->route('dashboard');
    }


    public function destroy(Request $request)
    {
        RestaurantType::destroy($request->id);
        return redirect()->route('dashboard');
    }
}
