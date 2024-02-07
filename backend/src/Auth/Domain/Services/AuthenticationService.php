<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\Services;

use Agenda\Auth\Domain\Dto\AuthenticationDto;

class AuthenticationService{
    public function __construct(){
        
    }
    public function authenticate(AuthenticationDto $authenticationDto){
        var_dump($authenticationDto);
    }
}