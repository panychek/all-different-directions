<?php

namespace Panychek\AllDifferentDirections\Command;

use Interop\Container\ContainerInterface;
use Panychek\AllDifferentDirections\Domain\ProposedRoute\RouteCollection;
use Zend\ServiceManager\Factory\FactoryInterface;

class ComputeCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $inputParser = $container->get(InputParser::class);

        $routeCollection = $container->get(RouteCollection::class);

        return new ComputeCommand($inputParser, $routeCollection);
    }
}
