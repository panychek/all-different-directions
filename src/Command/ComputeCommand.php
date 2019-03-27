<?php

namespace Panychek\AllDifferentDirections\Command;

use Panychek\AllDifferentDirections\Domain\ProposedRoute\RouteCollection;
use Zend\Console\Adapter\AdapterInterface as Console;
use ZF\Console\Route;

/**
 * Handles the "compute" CLI command
 * Takes a file path as an input parameter, computes the routes and prints the results
 *
 * @see https://open.kattis.com/problems/alldifferentdirections All Different Directions
 */
class ComputeCommand
{
    /**
     * @var InputParser
     */
    private $inputParser;

    /**
     * @var RouteCollection
     */
    private $routeCollection;

    /**
     * @param InputParser $inputParser
     * @param RouteCollection $routeCollection
     */
    public function __construct(
        InputParser $inputParser,
        RouteCollection $routeCollection
    ) {
        $this->inputParser = $inputParser;
        $this->routeCollection = $routeCollection;
    }

    /**
     * @param Route $route
     * @param Console $console
     */
    public function __invoke(Route $route, Console $console)
    {
        // Reading from a file
        $filePath = $route->getMatchedParam('file');
        if ($filePath) {
            $data = $this->inputParser->getFromFile($filePath);

            foreach ($data as $routes) {
                $outputLine = $this->createOutputLine($routes);
                $console->writeLine($outputLine);
            }
        }
    }

    /**
     * @param array $routes
     * @return string
     */
    private function createOutputLine(array $routes): string
    {
        $this->routeCollection->hydrate($routes);

        // Calculating the aggregates
        $avgDestination = $this->routeCollection->getAvgDestination();
        $distance = $this->routeCollection->getWorstDestinationsDistance($avgDestination);

        return sprintf(
            '%.6g %.6g %.6g',
            $avgDestination->getX(),
            $avgDestination->getY(),
            $distance
        );
    }
}
