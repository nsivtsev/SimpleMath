<?php

namespace nsivtsev\SimpleMathBundle\Entity;

interface MathInterface
{
    public function solveFromString(string $problem);
}