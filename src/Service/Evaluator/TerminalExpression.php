<?php
namespace nsivtsev\SimpleMathBundle\Service\Evaluator;

use nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions\Addition;
use nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions\Division;
use nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions\Multiplication;
use nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions\Number;
use nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions\Parenthesis;
use nsivtsev\SimpleMathBundle\Service\Evaluator\Expressions\Subtraction;
use Symfony\Component\Process\Exception\RuntimeException;

abstract class TerminalExpression {

    protected $value = '';

    public function __construct($value) {
        $this->value = $value;
    }

    public static function factory($value) {
        if (is_object($value) && $value instanceof TerminalExpression) {
            return $value;
        } elseif (is_numeric($value)) {
            return new Number($value);
        } elseif ($value == '+') {
            return new Addition($value);
        } elseif ($value == '-') {
            return new Subtraction($value);
        } elseif ($value == '*') {
            return new Multiplication($value);
        } elseif ($value == '/') {
            return new Division($value);
        } elseif (in_array($value, array('(', ')'))) {
            return new Parenthesis($value);
        }
        throw new RuntimeException('Undefined Value ' . $value);
    }

    abstract public function operate(Stack $stack);

    public function isOperator() {
        return false;
    }

    public function isParenthesis() {
        return false;
    }

    public function isNoOp() {
        return false;
    }

    public function render() {
        return $this->value;
    }
}