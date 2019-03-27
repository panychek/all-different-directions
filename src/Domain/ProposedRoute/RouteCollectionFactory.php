<?php

namespace Panychek\AllDifferentDirections\Domain\ProposedRoute;

use Interop\Container\ContainerInterface;
use Panychek\AllDifferentDirections\Hydrator\RouteIterator\RouteIteratorPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class RouteCollectionFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $routeIteratorManager = $container->get(RouteIteratorPluginManager::class);

        return new RouteCollection($routeIteratorManager);
    }
}
