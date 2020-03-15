<?php
namespace nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions;

use nsivtsev\SimpleMathBundle\Service\Evaluator\TerminalExpression;

class Number extends TerminalExpression {

    public function operate(Stack $stack) {
        return $this->value;
    }

}