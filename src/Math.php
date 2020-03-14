<?php
namespace nsivtsev\SimpleMathBundle;

use nsivtsev\SimpleMathBundle\Evaluator;

class Math
{
    public function calculate(string $problem)
    {
        $math = new \Evaluator();

        return $math->evaluate($problem);
    }

}