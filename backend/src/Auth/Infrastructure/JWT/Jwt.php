<?php

namespace Agenda\Auth\Infrastructure\JWT;

use Agenda\Auth\Domain\Entity\Users;
use Firebase\JWT\JWT as JWTFirebase;

class Jwt{
    public function validate()
    {}
    public function create(Users $users):string
    {
        $key = date('Yma').'agenda';

        $payload = [
            'exp' => time() + 2000,
            'iat' => time(),
            'data' => $users->getPublicValue()
        ];

        return JWTFirebase::encode($payload,$key,'HS256');
    }
}