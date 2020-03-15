<?php
namespace nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions;

use nsivtsev\SimpleMathBundle\Service\Evaluator\Stack;

class Division extends Operator {

    protected $precidence = 5;

    public function operate(Stack $stack) {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return $right / $left;
    }

}