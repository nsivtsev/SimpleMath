<?php
namespace nsivtsev\SimpleMathBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SimpleMathBundle extends Bundle
{
    public function calculate(string $problem)
    {
        return $problem;
    }
}