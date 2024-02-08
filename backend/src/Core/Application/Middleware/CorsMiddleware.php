<?php

namespace Agenda\Core\Application\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class CorsMiddleware{
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        $response = $next($request, $response);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'DNT,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Range,Authorization');
    }
}