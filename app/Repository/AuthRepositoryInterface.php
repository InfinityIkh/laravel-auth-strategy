<?php

namespace App\Repositories;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email): ?User;

    public function createToken(User $user, string $name): string;

    public function revokeCurrentToken(User $user): void;
}