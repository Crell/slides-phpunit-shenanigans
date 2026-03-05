<?php

namespace Crell\Shenanigans\Requests;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return match ($request->getUri()->getPath()) {
            '/beep' => new Response(200),
            '/create' => new Response(201)->withHeader('Location', '/beep/1'),
            default => new Response(404),
        };
    }
}
