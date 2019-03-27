<?php

namespace Panychek\AllDifferentDirections\Hydrator\Route;

use Interop\Container\ContainerInterface;
use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Creates an aggregate hydrator to hydrate the route
 */
class RouteHydratorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = new AggregateHydrator();

        $routeHydrator = $container->get(RouteEntityHydrator::class);
        $locationHydrator = $container->get(RouteLocationHydrator::class);

        $hydrator->add($locationHydrator);
        $hydrator->add($routeHydrator);

        return $hydrator;
    }
}
