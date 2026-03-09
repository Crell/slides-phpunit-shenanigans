<?php

namespace Crell\Shenanigans\Drivers;

use Crell\Shenanigans\Drivers\Backend;

class RedisBackend implements Backend {
    public function doStuff(string $stuff): string {
        return $stuff;
    }
}
