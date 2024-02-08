<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Services;

use Agenda\Auth\Domain\Dto\AuthenticationDto;
use Agenda\Auth\Infrastructure\JWT\Jwt;
use Agenda\Auth\Infrastructure\ReadModel\DoctrineOrm\GetUsersFromDoctrineOrm;

class AuthenticationService{

    public function __construct(
        private GetUsersFromDoctrineOrm $getUser,
        private Jwt $jwt
    ){

    }
    public function authenticate(AuthenticationDto $authenticationDto): array{
        $user = $this->getUser->byUsernameAndPassword(
            $authenticationDto->getPassword(),
            $authenticationDto->getUsername()
        );

        $token = $this->jwt->create($user);
        return [
            'token' => $token,
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
        
    }
}