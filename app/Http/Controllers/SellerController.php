<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    public function index()
    {
        return view('seller.sellerPanel');
    }


    public function store(Request $request)
    {
        $request->validate(['phone_number' => 'unique:' . Restaurant::class]);

        $address = Address::create([
            'title' => $request->name . "'s address",
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        Restaurant::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'type_id' => $request->type_id,
            'phone_number' => $request->phone_number,
            'address_id' => $address->id,
            'account_number' => $request->accountNumber,
        ]);

        Session::flash("success", "Restaurant Info Saved");
        return redirect('/dashboard/seller');
    }


    public function edit(string $id)
    {
        return view('seller.editRestaurantInfo', compact('id'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'regex:/(\w\s*){3,100}$/i'],
            'type_id' => ['required', 'numeric', 'exists:' . RestaurantType::class . ',id'],
            'phone_number' => ['required', 'numeric', new PhoneNumber],
            'address' => ['required', 'string', 'min:10', 'max:500'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'accountNumber' => ['required', 'regex:/(\d){10,20}$/i'],
        ]);

        $restaurant = Restaurant::find($id);
        if (!is_null($restaurant)) {

            if ($restaurant->phone_number != $request->phone_number) {
                $request->validate(['phone_number' => 'unique:' . Restaurant::class]);
            }

            $availableAddress = $restaurant->address()->first();
            $inputAddress = [
                'title' => $request->name . "'s address",
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            if (is_null($availableAddress)) {
                $availableAddress = Address::create($inputAddress);
            } else {
                Address::where('id', $availableAddress->id)->update($inputAddress);
            }

            $restaurant->name = $request->name;
            $restaurant->user_id = Auth::id();
            $restaurant->type_id = $request->type_id;
            $restaurant->phone_number = $request->phone_number;
            $restaurant->address_id = $availableAddress->id;
            $restaurant->account_number = $request->accountNumber;
            $restaurant->save();

            Session::flash("success", "Restaurant Info Updated");
            return redirect('/dashboard/seller');
        } else {

            return $this->store($request);
        }
    }
}
