<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User
            ::where('email', $request->email)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Incorrect.']
            ]);
        }

        return $user->createToken('vue_app')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json('logout', 201);
    }
}
