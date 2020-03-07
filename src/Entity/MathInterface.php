<?php

namespace nsivtsev\SimpleMathBundle\Entity;

interface MathInterface
{
    public function solve(string $problem);
}