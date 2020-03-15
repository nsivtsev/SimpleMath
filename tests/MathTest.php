<?php

namespace nsivtsev\SimpleMathBundle\Tests;

use nsivtsev\SimpleMathBundle\Math;
use nsivtsev\SimpleMathBundle\Service\Evaluator\Evaluator;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{

//    dump($math->calculate('2+2*2'));
//    //dump($math->calculate('2+2/0'));
//    dump($math->calculate('0000001'));
//    //dump($math->calculate('(2+2'));
//    //dump($math->calculate('000001 +'));
//    dump($math->calculate('000001 + 000001'));
//    //dump($math->calculate('aaaa'));
//    //dump($math->calculate('1a+1'));
//    //dump($math->calculate('.0+0.'));
//    //dump($math->calculate('0.+.0'));
//    dump($math->calculate('0.1 + 2.1'));
//    dump($math->calculate('-1000 + 1'));

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

    public function testZeroDivisionThrowsException()
    {
        $calculator = new Math(new Evaluator());

        $this->expectException(Exception::class);
        $calculator->solve("2/0");
    }
//
//    public function testNotEnoughtArgumentsThrowsException()
//    {
//        $calculator = new Math();
//
//        $this->expectExceptionMessage('Недостаточно данных в стеке для операции');
//        $calculator->solve("+");
//    }
//
//    public function testInvalidSymbolThrowsException()
//    {
//        $calculator = new Math();
//
//        $this->expectExceptionMessage('Недостаточно данных в стеке для операции');
//        $calculator->solve("3 +", true);
//    }
}