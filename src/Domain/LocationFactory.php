<?php

namespace Panychek\AllDifferentDirections\Domain;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class LocationFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $x = 0;
        $y = 0;

        return new Location($x, $y);
    }
}
