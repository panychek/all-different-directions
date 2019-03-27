<?php

namespace Panychek\AllDifferentDirections\Hydrator\RouteIterator;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RouteIteratorPluginManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = [
            'factories' => [
                'RouteIterator' => RouteIteratorFactory::class,
            ],
        ];

        return new RouteIteratorPluginManager($container, $config);
    }
}
