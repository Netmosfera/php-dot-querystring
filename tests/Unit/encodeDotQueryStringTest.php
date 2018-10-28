<?php declare(strict_types=1);

namespace PHPToolBucket\DotQueryStringTests\Unit;

use PHPToolBucket\DotQueryString;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class encodeDotQueryStringTest extends TestCase
{
    function testEncodeDotQueryStringWithSingleDimensionalArray()
    {
        $dummyData = [
            'a' => '1',
            'b' => '2',
            'c' => '3'
        ];
        $this->assertSame('a=1&b=2&c=3', DotQueryString\encodeDotQueryString($dummyData));
    }

    function testEncodeDotQueryStringWithTwoDimensionalArray()
    {
        $dummyData = [
            'a' => '1',
            'b' => '2',
            'c' => [
                'd' => '4',
                'e' => '5',
                'f' => '6'
            ]
        ];
        $this->assertSame('a=1&b=2&c.d=4&c.e=5&c.f=6', DotQueryString\encodeDotQueryString($dummyData));
    }

    function testEncodeDotQueryStringWithMultiDimensionalArray()
    {
        $dummyData = [
            'a' => '1',
            'b' => '2',
            'c' => [
                'd' => '4',
                'e' => '5',
                'f' => [
                    'g' => '7',
                    'h' => '8',
                    'i' => '9',
                ]
            ]
        ];
        $this->assertSame('a=1&b=2&c.d=4&c.e=5&c.f.g=7&c.f.h=8&c.f.i=9', DotQueryString\encodeDotQueryString($dummyData));
    }
}