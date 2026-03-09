<?php

namespace Crell\Shenanigans\Drivers;

use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Group;

#[Group('sql'), Group('runner')]
class SqlRunnerTest extends RunnerTestCases {
    #[Before]
    public function setupBackend(): void {
        $this->backend = new SqlBackend();
    }
}
