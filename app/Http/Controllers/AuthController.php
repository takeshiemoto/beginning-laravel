<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $token = $this->authService->attempt($credentials);
        if (!$token) {
            throw new AuthenticationException();
        }
        return response()->json(new AuthResource($token), Response::HTTP_OK);
    }

    public function me(Request $request)
    {
        return response()->json(new UserResource($request->user()), Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
