<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddAddressRequest $request)
    {
        $inputs = $request->validated();
        $address = new Address();
        $address->title = $inputs['title'];
        $address->address = $inputs['address'];
        $address->latitude = $inputs['latitude'];
        $address->longitude = $inputs['longitude'];
        $address->user_id = Auth::id();
        $address->save();
        return ["msg" => "Address added successfully."];
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return AddressResource::collection(Address::where('user_id', Auth::id())->get());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $addressId)
    {
        if ($request->user()->id == $addressId['user_id']) {
            $user = $request->user();
            $user->current_address_id = $addressId['id'];
            $user->save();
            return response()->json(["msg" => "current address updated successfully"]);
        }else{
            return response()->json(['msg' => 'the given address_id is wrong.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
