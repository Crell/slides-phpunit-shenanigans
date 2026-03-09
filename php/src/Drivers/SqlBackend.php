<?php

namespace Crell\Shenanigans\Drivers;

class SqlBackend implements Backend {
    public function doStuff(string $stuff): string {
        return $stuff;
    }
}
