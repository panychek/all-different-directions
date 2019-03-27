<?php

namespace Panychek\AllDifferentDirections\Domain\Instruction;

use Panychek\AllDifferentDirections\Domain\ProposedRoute\Route;

class TurnInstruction extends AbstractInstruction implements ExecutableInstructionInterface
{
    public const COMMAND = 'turn';

    /**
     * Make a turn
     *
     * @param Route $route
     */
    public function execute(Route $route)
    {
        $route->setAngle($route->getAngle() + $this->num);
    }
}
