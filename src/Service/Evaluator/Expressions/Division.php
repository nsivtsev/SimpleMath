<?php
namespace nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions;

use InvalidArgumentException;
use nsivtsev\SimpleMathBundle\Service\Evaluator\Stack;

class Division extends Operator {

    protected $precidence = 5;

    public function operate(Stack $stack) {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        if ($left == 0)
            throw new InvalidArgumentException('Division by zero');
        return $right / $left;
    }

}