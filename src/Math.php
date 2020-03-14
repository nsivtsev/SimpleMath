<?php
namespace nsivtsev\SimpleMathBundle;

use nsivtsev\SimpleMathBundle\Utils\Evaluator;

class Math
{
    public function calculate(string $problem)
    {
        $math = new Evaluator();

        return $math->evaluate($problem);
    }

}