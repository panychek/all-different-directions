<?php

namespace Panychek\AllDifferentDirections\Hydrator\Route;

use Panychek\AllDifferentDirections\Domain\ProposedRoute\Route;
use Zend\Hydrator\AbstractHydrator;
use Zend\Hydrator\ReflectionHydrator;

class RouteLocationHydrator extends AbstractHydrator
{
    /**
     * @var ReflectionHydrator
     */
    private $reflectionHydrator;

    /**
     * @param ReflectionHydrator $reflectionHydrator
     */
    public function __construct(ReflectionHydrator $reflectionHydrator)
    {
        $this->reflectionHydrator = $reflectionHydrator;
    }

    /**
     * {@inheritDoc}
     */
    public function extract(object $object): array
    {
        if (!$object instanceof Route) {
            return [];
        }

        $currentLocation = $object->getCurrentLocation();

        $data['location'] = $this->reflectionHydrator->extract($currentLocation);

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate(array $data, object $object)
    {
        if (!$object instanceof Route) {
            return [];
        }

        $currentLocation = $object->getCurrentLocation();
        $currentLocation = $this->reflectionHydrator->hydrate($data['location'], $currentLocation);

        $object->setCurrentLocation($currentLocation);

        return $object;
    }
}
