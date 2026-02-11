<?php

namespace Crell\Shenanigans\Shapes;

class Circle implements TwoDShape
{
    public float $area { get => M_PI * ($this->radius ** 2); }

    public function __construct(public readonly int $radius) {}
}
