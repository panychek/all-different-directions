<?php

namespace Panychek\AllDifferentDirections\Domain\ProposedRoute;

use Panychek\AllDifferentDirections\Domain\Location;
use Panychek\AllDifferentDirections\Hydrator\RouteIterator\RouteIteratorPluginManager;
use Zend\Stdlib\ArrayObject;

/**
 * Represents a collection of routes - so-called "test case"
 */
class RouteCollection extends ArrayObject
{
    /**
     * @var RouteIteratorPluginManager
     */
    private $routeIteratorManager;

    /**
     * @param RouteIteratorPluginManager $routeIteratorManager
     */
    public function __construct(RouteIteratorPluginManager $routeIteratorManager)
    {
        parent::__construct();

        $this->routeIteratorManager = $routeIteratorManager;
    }

    /**
     * Calculate the average destination for this collection
     *
     * @return Location
     */
    public function getAvgDestination(): Location
    {
        $x = [];
        $y = [];

        /** @var Route $route */
        foreach ($this->storage as $route) {
            $route->calculate();

            $destination = $route->getCurrentLocation();
            $x[] = $destination->getX();
            $y[] = $destination->getY();
        }

        $count = count($this->storage);

        $avgX = array_sum($x) / $count;
        $avgY = array_sum($y) / $count;

        return new Location($avgX, $avgY);
    }

    /**
     * Calculate how far off are the worst directions in this collection
     *
     * @param Location $avgDestination
     * @return float
     */
    public function getWorstDestinationsDistance(Location $avgDestination): float
    {
        $distance = 0;

        /** @var Route $route */
        foreach ($this->storage as $route) {
            $destination = $route->getCurrentLocation();
            $x = $avgDestination->getX() - $destination->getX();
            $y = $avgDestination->getY() - $destination->getY();

            $hypotenuse = hypot($x, $y);
            $distance = max($distance, $hypotenuse);
        }

        return floatval($distance);
    }

    /**
     * @param array $data
     */
    public function hydrate(array $data)
    {
        $this->clear(); // Starting from scratch

        $options = [
            'data' => $data
        ];

        $hydratingRouteIterator = $this->routeIteratorManager->get('RouteIterator', $options);
        foreach ($hydratingRouteIterator as $hydratedRoute) {
            $this->append($hydratedRoute);
        }
    }

    private function clear()
    {
        $this->exchangeArray([]);
    }
}
