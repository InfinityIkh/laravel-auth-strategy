<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SpaAuthService implements AuthStrategyInterface
{
    public function __construct(private AuthRepositoryInterface $repository)
    {}

    public function login(UserRequest $request)
    {
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Login successful.',
            'user' => $request->user(),
        ]);
    }

    public function logout(UserRequest $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successful.'
        ]);
    }

    public function user(UserRequest $request)
    {
        return response()->json([
            'user' => $request->user()
        ],200);
    }
}