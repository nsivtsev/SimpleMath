<?php

namespace nsivtsev\SimpleMathBundle\Tests;

use Error;
use ErrorException;
use InvalidArgumentException;
use nsivtsev\SimpleMathBundle\Math;
use nsivtsev\SimpleMathBundle\Service\Evaluator\Evaluator;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class MathTest extends TestCase
{

    public function testRandomCalculations()
    {
        $math = new Math(new Evaluator());
        $arg1 = mt_rand();
        $arg2 = mt_rand();
        $arg3 = mt_rand();
        $arg4 = mt_rand();

        $result = ($arg1 + $arg2 * $arg3) / $arg4;
        $str = "(".$arg1." + ".$arg2." * ".$arg3.") / ".$arg4;

        $this->assertEquals($result, $math->solve($str));
    }

    public function testPrior()
    {
        $calculator = new Math(new Evaluator());
        $result = $calculator->solve("2+2*2");

        $this->assertEquals(6, $result);
    }

    public function testParenthesisRunsFirst()
    {
        $calculator = new Math(new Evaluator());

        $result = $calculator->solve("2+(2+2)*2");

        $this->assertEquals(10, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testZeroDivisionThrowsException()
    {
        $calculator = new Math(new Evaluator());

        $this->expectException(InvalidArgumentException::class);
        $calculator->solve("2/0");
    }

    public function testNotEnoughtArgumentsThrowsException()
    {
        $calculator = new Math(new Evaluator());

        $this->expectException(Error::class);
        $calculator->solve("+");
    }

    public function testInvalidSymbolThrowsException()
    {
        $calculator = new Math(new Evaluator());

        $this->expectException(RuntimeException::class);
        $calculator->solve("aaa");
    }

    public function testMissedParethesisThrowsException()
    {
        $calculator = new Math(new Evaluator());

        $this->expectException(RuntimeException::class);
        $calculator->solve("2+2+(2*21");
    }

    public function testNullsBeforeDigits()
    {
        $calculator = new Math(new Evaluator());

        $this->assertEquals(1, $calculator->solve("00000001"));
    }

    public function testDotBefore()
    {
        $calculator = new Math(new Evaluator());

        $this->assertEquals(1.01, $calculator->solve(".01 + 1"));
    }

    public function testDotAfterThrowsException()
    {
        $calculator = new Math(new Evaluator());

        $this->expectException(RuntimeException::class);
        $calculator->solve(".0 + 0.");
    }
}