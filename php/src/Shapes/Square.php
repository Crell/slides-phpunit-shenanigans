<?php

namespace Crell\Shenanigans\Shapes;

class Square extends Rectangle
{
    public function __construct(int $size)
    {
        parent::__construct($size, $size);
    }
}
