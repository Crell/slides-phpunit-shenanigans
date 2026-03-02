<?php

namespace Crell\Shenanigans\Shapes;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[TestDox('A rectangle with documentation')]
class DocumentedRectangleTest extends TestCase
{
    public static function areaProvider(): \Generator
    {
        yield '2x2=4' => [
            'height' => 2,
            'width' => 2,
            'expectedArea' => 4,
        ];
        yield '3x2=6' => [
            'height' => 3,
            'width' => 2,
            'expectedArea' => 6,
        ];
        yield '2x3=6' => [
            'expectedArea' => 6,
            'height' => 2,
            'width' => 3,
        ];
    }

//    #[Test]
//    #[TestDox('Area validation')]
    #[TestDox('A rectangle with height $height and width $width has an area of $expectedArea')]
    #[DataProvider('areaProvider')]
    public function areaWithProvider(int $height, int $width, float $expectedArea): void
    {
        $r = new Rectangle($height, $width);
        self::assertSame($expectedArea, $r->area);
    }

}
