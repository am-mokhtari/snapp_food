<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
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
        return view('admin.createDiscountCode');
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return view('admin.editDiscountCode', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DiscountCode::destroy($request->id);
        return redirect()->route('dashboard');
    }
}
