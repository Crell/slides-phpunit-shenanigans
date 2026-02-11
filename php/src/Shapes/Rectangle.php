<?php

namespace Crell\Shenanigans\Shapes;

class Rectangle implements TwoDShape
{
    public float $area { get => $this->height * $this->width; }

    public function __construct(public int $height, public int $width) {}
}
