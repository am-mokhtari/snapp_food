<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserInfoUpdated;
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
        if ($request->has('phone_number')) {
            $request->phone_number = strrev((str_split(strrev($request->phone_number), 10))[0]);
        }

        $request->validate([
            'name' => ['string', 'max:255', 'min:3'],
            'email' => ['string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['numeric', 'unique:' . User::class, new PhoneNumber],
        ]);

        $changes = [];
        $user = Auth::user();

        if ($request->has('name')) {
            $user->name = $request->name;
            $changes[] = "name";
        }
        if ($request->has('email')) {
            $user->email = $request->email;
            $changes[] = "email";
        }
        if ($request->has('phone_number')) {
            $user->phone_number = $request->phone_number;
            $changes[] = "phone number";
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
            $changes[] = "password";
        }
        if (empty($changes)) {
            return response()->json(["msg" => "Enter a value for change information"]);
        } else {
            $user->save();
            $user->notify(new UserInfoUpdated($changes));
            return response()->json(['msg' => 'your info is updated successfully.']);
        }
    }


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


    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->has('phone_number')) {
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
