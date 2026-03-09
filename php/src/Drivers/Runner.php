<?php

namespace Crell\Shenanigans\Drivers;

class Runner {
    public function __construct(
        readonly private Backend $backend,
    ) {}

    public function run($stuff): string {
        return $this->backend->doStuff($stuff);
    }
}
