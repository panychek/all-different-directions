<?php

namespace Panychek\AllDifferentDirections\Hydrator\RouteIterator;

use Interop\Container\ContainerInterface;
use Panychek\AllDifferentDirections\Domain\ProposedRoute\Route;
use Zend\Hydrator\Aggregate\AggregateHydrator;
use Zend\Hydrator\Iterator\HydratingArrayIterator;
use Zend\ServiceManager\Factory\FactoryInterface;

class RouteIteratorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var AggregateHydrator $hydrator */
        $hydrator = $container->get('RouteHydrator');

        $route = $container->get(Route::class);

        return new HydratingArrayIterator($hydrator, $options['data'], $route);
    }
}
