<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::password($validatedData['password']);

        $user = User::create($validatedData);
        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->created([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, (string) $user->password)) {
            return $this->unauthorized('Incorrect email or password.');
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token
        ], 'Logged in successfully');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(null, 'Logged out successfully');
    }
}

