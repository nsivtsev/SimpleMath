<?php

namespace nsivtsev\SimpleMathBundle\Entity;

class Math implements MathInterface
{
    /**
     * Math constructor.
     */
    public function __construct()
    {
    }

    public function solveFromString(string $problem)
    {
        return "OLOLO";
    }
}