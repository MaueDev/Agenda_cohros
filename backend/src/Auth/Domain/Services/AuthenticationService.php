<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Services;

use Agenda\Auth\Domain\Dto\AuthenticationDto;
use Agenda\Auth\Domain\ReadModel\GetUsers;
use Agenda\Auth\Infrastructure\JWT\Jwt;

class AuthenticationService
{
    public function __construct(
        private GetUsers $getUser,
        private Jwt $jwt
    ) {
    }

    public function authenticate(AuthenticationDto $authenticationDto): array
    {
        $user = $this->getUser->byUsernameAndPassword(
            $authenticationDto->getUsername(),
            $authenticationDto->getPassword()
        );

        $token = $this->jwt->create($user);
        return [
            'token' => $token,
            'name'  => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }
}
