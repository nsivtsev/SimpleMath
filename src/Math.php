<?php
namespace nsivtsev\SimpleMathBundle;

use nsivtsev\SimpleMathBundle\Utils\Evaluator;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class Math extends Bundle
{
    public function calculate(string $problem)
    {
        $math = new Evaluator();

        return $math->evaluate($problem);
    }

}