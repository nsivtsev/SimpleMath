<?php

namespace nsivtsev\SimpleMathBundle\Tests\Util;

use nsivtsev\SimpleMathBundle\Util\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Math();
        $result = $calculator->solve("2+2*2");

        $this->assertEquals(6, $result);
    }
}