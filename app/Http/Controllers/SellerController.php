<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('seller.sellerPanel');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $info = new Restaurant;
        $info->name = $request->name;
        $info->user_id = Auth::user()->id;
        $info->type_id = $request->type_id;
        $info->phone_number = $request->phone_number;
        $info->address = $request->address;
        $info->account_number = $request->accountNumber;
        $info->save();

        Session::flash("success", "Restaurant Info Saved");
        return redirect('/dashboard/seller');
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
        return view('seller.editRestaurantInfo', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['regex:/(\w\s*){3,100}$/i'],
            'type_id' => ['numeric', 'exists:'.RestaurantType::class.',id'],
            'phone_number' => ['required', 'numeric', new PhoneNumber],
            'address' => ['regex:/(\w\s*){5,}$/i'],
            'accountNumber' => ['regex:/(\d){10,20}$/i']
        ]);

        $info = Restaurant::find($id);
        if (!is_null($info)){
            $info->name = $request->name;
            $info->user_id = Auth::user()->id;
            $info->type_id = $request->type_id;
            $info->phone_number = $request->phone_number;
            $info->address = $request->address;
            $info->account_number = $request->accountNumber;
            $info->save();

            Session::flash("success", "Restaurant Info Updated");
            return redirect('/dashboard/seller');
        }else{
            return $this->store($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
