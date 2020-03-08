<?php

namespace nsivtsev\SimpleMathBundle\Tests\Util;

use ErrorException;
use nsivtsev\SimpleMathBundle\Util\Math;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Warning;

class MathTest extends TestCase
{
    public function testPrior()
    {
        $calculator = new Math();
        $result = $calculator->solve("2+2*2");

        $this->assertEquals(6, $result);
    }

    public function testBracketsRunsFirst()
    {
        $calculator = new Math();
        $result = $calculator->solve("2+(2+2)*2");

        $this->assertEquals(10, $result);
    }

    public function testZeroDivisionThrowsException()
    {
        $this->expectException(Exception::class);
        $calculator = new Math();
        $calculator->solve("2/0");
    }

    public function testNotAllowedSymbolThrowsException()
    {
        $this->expectException();
        $calculator = new Math();
        $calculator->solve("2+2!1");
    }
}