<?php

declare(strict_types=1);

namespace Agenda\Auth\Infrastructure\JWT;

use Agenda\Auth\Domain\Entity\Users;
use Exception;
use Firebase\JWT\JWT as JWTFirebase;
use Firebase\JWT\Key;
use stdClass;
use Throwable;

class Jwt
{
    public function validate(string $header): stdClass
    {
        $token = str_replace('Bearer ', '', $header);
        $key   = date('Ymd') . 'agenda';
        try {
            return JWTFirebase::decode($token, new Key($key, 'HS256'));
        } catch (Throwable $th) {
            throw new Exception($th->getMessage(), 401);
        }
    }

    public function create(Users $users): string
    {
        $key = date('Ymd') . 'agenda';

        $payload = [
            'exp'  => time() + 20000,
            'iat'  => time(),
            'data' => $users->getPublicValue(),
        ];

        return JWTFirebase::encode($payload, $key, 'HS256');
    }

    public function decode(string $header): stdClass
    {
        $token = str_replace('Bearer ', '', $header);
        $key   = date('Ymd') . 'agenda';
        return JWTFirebase::decode($token, new Key($key, 'HS256'));
    }
}
