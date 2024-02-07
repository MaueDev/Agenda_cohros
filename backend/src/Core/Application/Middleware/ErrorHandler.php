<?php

namespace Agenda\Core\Application\Middleware;

use InvalidArgumentException;
use Slim\Http\Request;
use Slim\Http\Response;
class ErrorHandler{
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        try {
            $response = $next($request, $response);
        }catch (InvalidArgumentException $e) {
            $response = $response
                ->withStatus(400)
                ->withJson([
                    'status_code' => 400,
                    'type'        => 'InvalidParameter',
                    'messages'    => [$e->getMessage()],
                ]);
        }
        return $response;
    }
}