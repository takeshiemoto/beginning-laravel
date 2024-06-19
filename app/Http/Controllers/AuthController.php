<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::guard('web')->attempt($credentials)) {
            $token = Auth::user()->createToken('AccessToken')->plainTextToken;
            return response()->json(['token' => $token]);
        }
        throw new AuthenticationException();
    }

    public function me(Request $request)
    {
        return response()->json(
            [
                $request->user()->name,
                $request->user()->email,
            ]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout']);
    }
}
