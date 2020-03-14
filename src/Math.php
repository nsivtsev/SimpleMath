<?php
namespace nsivtsev\SimpleMathBundle;

use nsivtsev\SimpleMathBundle\Service\Evaluator;

class Math
{
    private $calculator;

    /**
     * Math constructor.
     * @param null $calculator
     */
    public function __construct($calculator = null)
    {
        if (!$calculator)
            $this->calculator = new Evaluator();
        else
            $this->calculator = $calculator;
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