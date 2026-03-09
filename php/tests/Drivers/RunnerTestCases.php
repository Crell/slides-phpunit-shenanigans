<?php

namespace Crell\Shenanigans\Drivers;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

abstract class RunnerTestCases extends TestCase {

    protected Backend $backend;

    abstract function setupBackend(): void;

    public static function runProvider(): \Generator {
        yield ['a'];
        yield ['b'];
    }

    #[DataProvider('runProvider')]
    public function testRun(string $val): void {
        $runner = new Runner($this->backend);
        self::assertSame($val, $runner->run($val));
    }
}
