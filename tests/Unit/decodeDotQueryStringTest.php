<?php declare(strict_types=1);

namespace PHPToolBucket\DotQueryStringTests\Unit;

use PHPToolBucket\DotQueryString;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class decodeDotQueryStringTest extends TestCase
{
    function testDecodeDotQueryStringWithAReqularQueryString()
    {
        $dummyQueryString = "a=1&b=2&c=3";
        $this->assertSame([
            'a' => '1',
            'b' => '2',
            'c' => '3'
        ], DotQueryString\decodeDotQueryString($dummyQueryString));
    }
    
    function testDecodeDotQueryStringWithATwoDimensionalQueryString()
    {
        $dummyQueryString = "a=1&b=2&c.d=4&c.e=5&c.f=6";
        $this->assertSame([
            'a' => '1',
            'b' => '2',
            'c' => [
                'd' => '4',
                'e' => '5',
                'f' => '6'
            ]
        ], DotQueryString\decodeDotQueryString($dummyQueryString));
    }
    
    function testDecodeDotQueryStringWithAMultiDimensionalQueryString()
    {
        $dummyQueryString = "a=1&b=2&c.d=4&c.e=5&c.f.g=7&c.f.h=8&c.f.i=9";
        $this->assertSame([
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
        ], DotQueryString\decodeDotQueryString($dummyQueryString));
    }
}