<?php
namespace nsivtsev\SimpleMathBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SimpleMathBundle extends Bundle
{
    public function calculate(string $problem)
    {
        return $problem;
    }
}