<?php

namespace Agenda\Auth\Application\Middleware;

use Agenda\Auth\Infrastructure\JWT\Jwt;
use Slim\Http\Request;
use Slim\Http\Response;

class JwtAuthMiddleware
{
    protected $jwt;

    public function __construct(Jwt $jwt)
    {
        $this->jwt = $jwt;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $token = $request->getHeaderLine('Authorization');
        if (empty($token)) {
            return $response->withStatus(401)->withJson(['error' => 'Token de autorização ausente']);
        }

        try {
            $decodedToken = $this->jwt->validate($token);
            return $next($request->withAttribute('user', $decodedToken), $response);
        } catch (\Exception $e) {
            return $response->withStatus(401)->withJson(['error' => $e->getMessage()]);
        }
    }
}
