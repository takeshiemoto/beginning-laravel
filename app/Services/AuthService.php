<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attempt($credentials)
    {
        if (Auth::guard('web')->attempt($credentials)) {
            return Auth::user()->createToken('AccessToken')->plainTextToken;
        }
        return false;
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
    }
}
