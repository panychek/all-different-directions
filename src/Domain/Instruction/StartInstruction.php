<?php

namespace Panychek\AllDifferentDirections\Domain\Instruction;

use Panychek\AllDifferentDirections\Domain\ProposedRoute\Route;

class StartInstruction extends AbstractInstruction implements ExecutableInstructionInterface
{
    public const COMMAND = 'start';

    /**
     * Initiate the first turn
     *
     * @param Route $route
     */
    public function execute(Route $route)
    {
        $route->setAngle($this->num);
    }
}
