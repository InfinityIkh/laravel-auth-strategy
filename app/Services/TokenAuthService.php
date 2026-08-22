<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class TokenAuthService implements AuthStrategyInterface
{
    public function __construct(private AuthRepositoryInterface $repository)
    {}

    public function login(UserRequest $request)
    {
        $user = $this->repository->findByEmail(
            $request->email
        );

        if (!$user ||!Hash::check($request->password, $user->password))
        {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $token = $this->repository->createToken(
            $user,
            'auth-token'
        );

        return response()->json([
            'message' => 'Login successful.',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(UserRequest $request)
    {
        $this->repository->revokeCurrentToken(
            $request->user()
        );

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