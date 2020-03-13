<?php
namespace nsivtsev\SimpleMathBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Math extends Bundle
{
    public function calculate(string $problem)
    {
        return $problem;
    }
}