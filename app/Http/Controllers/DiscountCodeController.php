<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public function create()
    {
        return view('admin.createDiscountCode');
    }


    public function store(Request $request)
    {
        $discount = new DiscountCode();
        $discount->code = $request->code;
        $discount->percents = $request->percents;
        $discount->expiration_date = $request->expDate;
        $discount->expiration_time = $request->expTime;
        $discount->save();

        return redirect()->route('dashboard');
    }


    public function edit(string $id)
    {
        return view('admin.editDiscountCode', compact('id'));
    }


    public function update(Request $request)
    {
        $discount = DiscountCode::find($request->id);
        $discount->code = $request->code;
        $discount->percents = $request->percents;
        $discount->expiration_date = $request->expDate;
        $discount->expiration_time = $request->expTime;
        $discount->save();

        return redirect()->route('dashboard');
    }


    public function destroy(Request $request)
    {
        DiscountCode::destroy($request->id);
        return redirect()->route('dashboard');
    }
}
