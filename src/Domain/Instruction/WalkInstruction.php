<?php

namespace Panychek\AllDifferentDirections\Domain\Instruction;

use Panychek\AllDifferentDirections\Domain\ProposedRoute\Route;
use Panychek\AllDifferentDirections\Domain\Location;

class WalkInstruction extends AbstractInstruction implements ExecutableInstructionInterface
{
    public const COMMAND = 'walk';

    /**
     * Walk to the new spot
     *
     * @param Route $route
     */
    public function execute(Route $route)
    {
        $currentLocation = $route->getCurrentLocation();

        $angle = $route->getAngle();
        $radians = deg2rad($angle);

        $x = $currentLocation->getX();
        $shift = $this->num * cos($radians);
        $x += $shift;

        $y = $currentLocation->getY();
        $shift = $this->num * sin($radians);
        $y += $shift;

        $newLocation = new Location($x, $y);
        $route->setCurrentLocation($newLocation);
    }
}
