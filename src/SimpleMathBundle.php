<?php
namespace nsivtsev\SimpleMathBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SimpleMathBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->registerForAutoconfiguration(Math::class)->addTag(Math::TAG);
    }

}