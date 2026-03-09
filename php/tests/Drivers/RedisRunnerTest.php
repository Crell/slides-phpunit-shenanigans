<?php

namespace Crell\Shenanigans\Drivers;

use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Group;

#[Group('redis'), Group('runner')]
class RedisRunnerTest extends RunnerTestCases {
    #[Before]
    public function setupBackend(): void {
        $this->backend = new RedisBackend();
    }
}
