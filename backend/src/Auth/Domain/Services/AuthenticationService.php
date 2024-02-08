<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Services;

use Agenda\Auth\Domain\Dto\AuthenticationDto;
use Agenda\Auth\Infrastructure\ReadModel\DoctrineOrm\GetUsersFromDoctrineOrm;

class AuthenticationService{

    public function __construct(
        private GetUsersFromDoctrineOrm $getUser
    ){

    }
    public function authenticate(AuthenticationDto $authenticationDto){
        $this->getUser->byUsernameAndPassword(
            $authenticationDto->getPassword(),
            $authenticationDto->getUsername()
        );
        var_dump($authenticationDto);
    }
}