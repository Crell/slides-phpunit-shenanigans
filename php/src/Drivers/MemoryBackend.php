<?php

namespace Crell\Shenanigans\Drivers;

class MemoryBackend implements Backend {
    public function doStuff(string $stuff): string {
        return $stuff;
    }
}
