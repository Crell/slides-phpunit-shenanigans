<?php

namespace Crell\Shenanigans\Requests;

use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class RequestHandlerTest extends TestCase
{
    public static function v1Provider(): \Generator
    {
        yield 'just confirm a 200' => [
            'method' => 'GET',
            'uri' => '/beep',
            'body' => 'boop',
        ];

        yield 'confirm a not-found URL' => [
            'method' => 'GET',
            'uri' => '/missing',
            'expectedCode' => 404,
        ];

        yield 'create an object' => [
            'method' => 'POST',
            'uri' => '/create',
            'expectedCode' => 201,
            'expectedHeaders' => ['Location' => '/beep/1'],
        ];
    }

    #[Test, DataProvider('v1Provider')]
    public function v1(
        string $method,
        string|UriInterface $uri,
        $headers = [],
        ?string $body = null,
        int $expectedCode = 200,
        array $expectedHeaders = [],
        ?string $expectedBody = null,
        ): void {
        $request = new ServerRequest($method, $uri, $headers, $body);

        $handler = new RequestHandler();

        $res = $handler->handle($request);
        self::assertSame($expectedCode, $res->getStatusCode());
        if ($expectedBody) {
            self::assertSame($expectedBody, (string) $res->getBody());
        }

        foreach ($expectedHeaders as $header => $value) {
            $v = $res->getHeaderLine($header);
            self::assertNotNull($v);
            self::assertSame($value, $v);
        }
    }

    public static function v2Provider(): \Generator
    {
        yield 'just confirm a 200' => [
            'request' => new ServerRequest('GET', '/beep', [], 'boop'),
        ];

        yield 'confirm a not-found URL' => [
            'request' => new ServerRequest('GET', '/missing'),
            'expectedCode' => 404,
        ];

        yield 'create an object' => [
            'request' => new ServerRequest('POST', '/create'),
            'expectedCode' => 201,
            'expectedHeaders' => ['Location' => '/beep/1'],
        ];
    }

    #[Test, DataProvider('v2Provider')]
    public function v2(
        ServerRequest $request,
        int $expectedCode = 200,
        array $expectedHeaders = [],
        ?string $expectedBody = null,
    ): void {
        $handler = new RequestHandler();
        $res = $handler->handle($request);

        self::assertSame($expectedCode, $res->getStatusCode());
        if ($expectedBody) {
            self::assertSame($expectedBody, (string) $res->getBody());
        }
        foreach ($expectedHeaders as $header => $value) {
            $v = $res->getHeaderLine($header);
            self::assertNotNull($v);
            self::assertSame($value, $v);
        }
    }

    public static function v3Provider(): \Generator
    {
        yield 'just confirm a 200' => [
            'request' => new ServerRequest('GET', '/beep', [], 'boop'),
            'checks' => static function(ResponseInterface $response) {
                self::assertSame(200, $response->getStatusCode());
            },
        ];

        yield 'confirm a not-found URL' => [
            'request' => new ServerRequest('GET', '/missing'),
            'checks' => static function (ResponseInterface $response) {
                self::assertSame(404, $response->getStatusCode());
            },
        ];

        yield 'create an object' => [
            'request' => new ServerRequest('POST', '/create'),
            'checks' => static function (ResponseInterface $response) {
                self::assertSame(201, $response->getStatusCode());
                self::assertSame('/beep/1', $response->getHeaderLine('Location'));
            },
        ];
    }

    #[Test, DataProvider('v3Provider')]
    public function v3(ServerRequest $request, \Closure $checks): void
    {
        $handler = new RequestHandler();
        $res = $handler->handle($request);
        $checks($res);
    }
}
