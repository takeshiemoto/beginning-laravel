<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::guard('web')->attempt($credentials)) {
            $token = Auth::user()->createToken('AccessToken')->plainTextToken;
            return response()->json(new AuthResource($token), Response::HTTP_CREATED);
        }
        throw new AuthenticationException();
    }

    public function me(Request $request)
    {
        return response()->json(new UserResource($request->user()), Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
