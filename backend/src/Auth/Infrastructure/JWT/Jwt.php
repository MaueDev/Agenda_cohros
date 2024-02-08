<?php

namespace Agenda\Auth\Infrastructure\JWT;

use Agenda\Auth\Domain\Entity\Users;
use Firebase\JWT\JWT as JWTFirebase;
use Firebase\JWT\Key;
use stdClass;

class Jwt{
    public function validate(string $header): stdClass
    {
        $token = str_replace('Bearer ','',$header);
        $key = date('Ymd').'agenda';
        try {
            $decode = JWTFirebase::decode($token, new Key($key, 'HS256'));
            return $decode;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 401) ;
        }
    }
    public function create(Users $users):string
    {
        $key = date('Ymd').'agenda';

        $payload = [
            'exp' => time() + 2000,
            'iat' => time(),
            'data' => $users->getPublicValue()
        ];

        return JWTFirebase::encode($payload,$key,'HS256');
    }
}