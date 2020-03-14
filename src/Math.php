<?php
namespace nsivtsev\SimpleMathBundle;

use nsivtsev\SimpleMathBundle\Service\Evaluator;

class Math
{
    private $calculator;

    /**
     * Math constructor.
     * @param Evaluator $evaluator
     */
    public function __construct(Evaluator $evaluator)
    {
        $this->calculator = $evaluator;
    }

    /**
     * Вычисление из входящей строки
     * @param string $problem
     * @param Math $math
     * @return string
     */
    public function solve(string $problem, Math $math)
    {
        return $this->calculator->evaluate($problem);
    }

}