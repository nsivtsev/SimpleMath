<?php

namespace nsivtsev\SimpleMathBundle\Util;

use ReversePolishNotation;

class Math implements MathInterface
{
    /**
     * Math constructor.
     */
    public function __construct()
    {
    }

    public function solve(string $problem)
    {
        //используем библиотеку для приведения и вычисления обратной Польской записи
        $calculator = new ReversePolishNotation();
        return $calculator->calc($problem);
    }
}