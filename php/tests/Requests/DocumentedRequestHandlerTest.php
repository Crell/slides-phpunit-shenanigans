<?php

namespace Crell\Shenanigans\Requests;

use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Large;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestDoxFormatter;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

#[Large, TestDox('RequestHandler returns expected response')]
class DocumentedRequestHandlerTest extends TestCase
{

    #[Test, DataProvider('handlersProvider')]
    #[TestDoxFormatter('handlersFormatter')]
    public function handlers(
        ServerRequest $request,
        int $expectedCode = 200, array $expectedHeaders = [], ?string $expectedBody = null,
    ): void {
        $handler = new RequestHandler();
        $res = $handler->handle($request);

        self::assertSame($expectedCode, $res->getStatusCode());
        self::assertBody($expectedBody, $res);
        self::assertHeaders($expectedHeaders, $res);
    }

    public static function handlersFormatter(
        ServerRequest $request,
        int $expectedCode = 200, array $expectedHeaders = [], ?string $expectedBody = null,
    ): string {
        $formattedRequest = sprintf('%s %s', $request->getMethod(), $request->getUri()->getPath());
        return sprintf('%s responds with %d', $formattedRequest, $expectedCode);
    }

    public static function handlersProvider(): \Generator {
        yield 'just confirm a 200' => [
            'request' => new ServerRequest('GET', '/beep'),
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

    protected static function assertBody(?string $expectedBody, ResponseInterface $res): void {
        if ($expectedBody) {
            self::assertSame($expectedBody, (string) $res->getBody());
        }
    }

    protected static function assertHeaders(array $expectedHeaders, ResponseInterface $res): void {
        foreach ($expectedHeaders as $header => $value) {
            $v = $res->getHeaderLine($header);
            self::assertNotNull($v);
            self::assertSame($value, $v);
        }
    }
}
