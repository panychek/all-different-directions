<?php

namespace Panychek\AllDifferentDirections\Hydrator\Route;

use Interop\Container\ContainerInterface;
use Zend\Hydrator\ReflectionHydrator;
use Zend\ServiceManager\Factory\FactoryInterface;

class RouteLocationHydratorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = $container->get(ReflectionHydrator::class);

        return new RouteLocationHydrator($hydrator);
    }
}
