<?php
namespace nsivtsev\SimpleMathBundle;


use nsivtsev\SimpleMathBundle\Service\Evaluator\Evaluator;

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
     * @return string
     */
    public function solve(string $problem)
    {
        return $this->calculator->evaluate($problem);
    }

}