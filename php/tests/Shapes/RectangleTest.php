<?php

namespace Crell\Shenanigans\Shapes;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[Small]
class RectangleTest extends TestCase
{
    #[Test]
    public function areaOf2x2is4(): void
    {
        $r = new Rectangle(2, 2);
        self::assertSame(4.0, $r->area);
    }

    #[Test]
    public function areaOf3x2is6(): void
    {
        $r = new Rectangle(3, 2);
        self::assertSame(6.0, $r->area);
    }

    #[Test]
    public function areaOf2x3is6(): void
    {
        $r = new Rectangle(2, 3);
        self::assertSame(6.0, $r->area);
    }

    #[Test]
    #[TestWith([2, 2, 4], '2x2=4')]
    #[TestWith([3, 2, 6], '3x2=6')]
    #[TestWith([2, 3, 6], '2x3=6')]
    public function area(int $height, int $width, float $expectedArea): void
    {
        $r = new Rectangle($height, $width);
        self::assertSame($expectedArea, $r->area);
    }

    public static function areaProvider(): array
    {
        return [
            [2, 2, 4],
            [3, 2, 6],
            [2, 3, 6],
        ];
    }

    public static function areaProvider2(): \Generator
    {
        yield [2, 2, 4];
        yield [3, 2, 6];
        yield [2, 3, 6];
    }

    public static function areaProvider3(): \Generator
    {
        yield '2x2=4' => [2, 2, 5];
        yield '3x2=6' => [3, 2, 6];
        yield '2x3=6' => [2, 3, 6];
    }

    public static function areaProvider4(): \Generator
    {
        yield '2x2=4' => [
            'height' => 2,
            'width' => 2,
            'expectedArea' => 5,
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

    #[Test]
//    #[DataProvider('areaProvider')]
//    #[DataProvider('areaProvider2')]
    //#[DataProvider('areaProvider3')]
    #[DataProvider('areaProvider4')]
    public function areaWithProvider(int $height, int $width, float $expectedArea): void
    {
        $r = new Rectangle($height, $width);
        self::assertSame($expectedArea, $r->area);
    }

}
