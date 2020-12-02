<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'min:3', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(
                [
                    'message' => true
                ],
                201
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'message' => false
                ],
                422
            );
        }
    }
}
