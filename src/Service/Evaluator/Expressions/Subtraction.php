<?php
namespace nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions;

use nsivtsev\SimpleMathBundle\Service\Evaluator\Stack;

class Subtraction extends Operator {

    protected $precidence = 4;

    public function operate(Stack $stack) {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop();
        $right = ($right ? $right->operate($stack) : 0);
        return $right - $left;
    }

}