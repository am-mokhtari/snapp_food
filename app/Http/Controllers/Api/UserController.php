<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class UserController extends Controller
{
    public function updateInfo(Request $request)
    {
        if (isset($request->phone_number)) {
            $request->phone_number = strrev((str_split(strrev($request->phone_number), 10))[0]);
        }

        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['numeric', 'unique:' . User::class, new PhoneNumber],
        ]);

        $user = Auth::user();
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->phone_number = $request->phone_number ?? $user->phone_number;
        $user->password = $request->password ?? $user->password;
        $user->save();
        return response()->json(['msg' => 'your info is updated successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $username = [];
        if (is_numeric($request->username)) {
            $request->username = '0' . strrev((str_split(strrev($request->username), 10))[0]);
            $username = ['phone_number' => $request->username, 'password' => $request->password];
        } elseif (preg_match('/^[a-zA-Z].{3,20}@.{3,10}\.[a-zA-Z]{2,10}$/i', $request->username)) {
            $username = ['email' => $request->username, 'password' => $request->password];
        }

        if (Auth::attempt($username)) {
            $token = $request->user()->createToken("authenticated");
            return response()->json([
                'msg' => "You are signed in. Your Token is: " . $token->plainTextToken
            ]);
        } else {
            return response()->json([
                "msg" => "username or password is wrong."
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        if (isset($request->phone_number)) {
            $request->phone_number = strrev((str_split(strrev($request->phone_number), 10))[0]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'numeric', 'unique:' . User::class, new PhoneNumber],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        $token = $user->createToken("authenticated");
        return response()->json([
            "msg" => "You are signed up successfully. Your Token is: " . $token->plainTextToken . ". Dont Forget It."
        ]);
    }

    public function logout(Request $request)
    {
        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;
            $accessToken = $model::findToken($token);
            $accessToken->delete();
        }

        return new Response('', 204);
    }
}
