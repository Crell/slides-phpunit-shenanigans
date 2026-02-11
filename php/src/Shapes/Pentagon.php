<?php

namespace Crell\Shenanigans\Shapes;

class Pentagon implements TwoDShape
{
    // A=1/4 * √5(5+2√5)*s^2
    public float $area { get => 1/4 * sqrt(5* (5 + 2 * sqrt(5)) * $this->side ** 2); }

    public function __construct(public readonly int $side) {}
}
