<?php

namespace nsivtsev\SimpleMathBundle\Tests\Util;

use nsivtsev\SimpleMathBundle\Util\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testPrior()
    {
        $calculator = new Math();
        $result = $calculator->solve("2+2*2");

        $this->assertEquals(6, $result);
    }

    public function testBrackets()
    {
        $calculator = new Math();
        $result = $calculator->solve("(2+2)*2");

        $this->assertEquals(8, $result);
    }

    public function testZeroDivision()
    {
        $calculator = new Math();
        $result = $calculator->solve("2*0");

        $this->assertEquals(0, $result);
    }
}