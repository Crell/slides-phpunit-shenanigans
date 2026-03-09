<?php

namespace Crell\Shenanigans\Drivers;

use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Group;

#[Group('memory'), Group('runner')]
class MemoryRunnerTest extends RunnerTestCases {
    #[Before]
    public function setupBackend(): void {
        $this->backend = new MemoryBackend();
    }
}
