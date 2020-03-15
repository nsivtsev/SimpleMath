<?php
namespace nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions;

class Number extends TerminalExpression {

    public function operate(Stack $stack) {
        return $this->value;
    }

}