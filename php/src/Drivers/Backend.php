<?php

namespace Crell\Shenanigans\Drivers;

interface Backend {
    public function doStuff(string $stuff): string;
}
