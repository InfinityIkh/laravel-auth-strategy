<?php

namespace App\Services;

use InvalidArgumentException;

class AuthStrategyResolver
{
    public function resolve(string $type): AuthStrategyInterface
    {
        return match ($type) {
            'spa' => app(SpaAuthService::class),
            'token' => app(TokenAuthService::class),

            default => throw new InvalidArgumentException(
                "Unsupported authentication type."
            ),
        };
    }
}