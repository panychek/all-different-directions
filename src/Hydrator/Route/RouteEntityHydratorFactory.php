<?php

namespace Panychek\AllDifferentDirections\Hydrator\Route;

use Interop\Container\ContainerInterface;
use Panychek\AllDifferentDirections\Domain\Instruction\InstructionPluginManager;
use Zend\Hydrator\ReflectionHydrator;
use Zend\ServiceManager\Factory\FactoryInterface;

class RouteEntityHydratorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = $container->get(ReflectionHydrator::class);

        $instructionManager = $container->get(InstructionPluginManager::class);

        return new RouteEntityHydrator($hydrator, $instructionManager);
    }
}
