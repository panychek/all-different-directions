<?php

namespace Panychek\AllDifferentDirections\Domain\ProposedRoute;

use Interop\Container\ContainerInterface;
use Panychek\AllDifferentDirections\Domain\Location;
use Panychek\AllDifferentDirections\Validator\FirstInstructionValidator;
use Panychek\AllDifferentDirections\Validator\InstructionCountValidator;
use Zend\ServiceManager\Factory\FactoryInterface;

class RouteFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $location = $container->get(Location::class);

        $firstInstructionValidator = $container->get(FirstInstructionValidator::class);

        $instructionCountValidator = $container->get(InstructionCountValidator::class);

        return new Route($location, $firstInstructionValidator, $instructionCountValidator);
    }
}
