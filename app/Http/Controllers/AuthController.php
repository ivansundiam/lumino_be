<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request): JsonResponse {
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = User::create($validatedData);
            $token = $user->createToken('auth-token')->plainTextToken;

            return $this->created([
                'user' => $user,
                'token' => $token
            ]);

        } catch (\Exception $e) {
            return $this->error('Registration failed', 500, $e->getMessage());
        }
    }
}

