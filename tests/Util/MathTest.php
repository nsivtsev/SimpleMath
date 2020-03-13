<?php

namespace nsivtsev\SimpleMathBundle\Tests\Util;

use nsivtsev\SimpleMathBundle\Services\Math;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use Exeption;

class MathTest extends TestCase
{

    public function testRandomCalculations()
    {
        $calculator = new Math();

        $arg1 = mt_rand();
        $arg2 = mt_rand();
        $arg3 = mt_rand();
        $arg4 = mt_rand();

        $result = ($arg1 + $arg2 * $arg3) / $arg4;
        $str = "(".$arg1." + ".$arg2." * ".$arg3.") / ".$arg4;

        $this->assertEquals($result, $calculator->solve($str));
    }

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
        $calculator = new Math();

        $this->expectException(Exception::class);
        $calculator->solve("2/0");
    }

    public function testNotEnoughtArgumentsThrowsException()
    {
        $calculator = new Math();

        $this->expectExceptionMessage('Недостаточно данных в стеке для операции');
        $calculator->solve("+");
    }

    public function testInvalidSymbolThrowsException()
    {
        $calculator = new Math();

        $this->expectExceptionMessage('Недостаточно данных в стеке для операции');
        $calculator->solve("3 +", true);
    }
}