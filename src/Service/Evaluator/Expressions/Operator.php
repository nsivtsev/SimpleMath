<?php
namespace nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions;

use nsivtsev\SimpleMathBundle\Service\Evaluator\TerminalExpression;

abstract class Operator extends TerminalExpression {

    protected $precidence = 0;
    protected $leftAssoc = true;

    public function getPrecidence() {
        return $this->precidence;
    }

    public function isLeftAssoc() {
        return $this->leftAssoc;
    }

    public function isOperator() {
        return true;
    }

}