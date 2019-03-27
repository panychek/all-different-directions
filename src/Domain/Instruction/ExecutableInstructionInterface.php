<?php

namespace Panychek\AllDifferentDirections\Domain\Instruction;

use Panychek\AllDifferentDirections\Domain\ProposedRoute\Route;

interface ExecutableInstructionInterface
{
    /**
     * Execute the instruction and modify the route
     *
     * @param Route $route
     */
    public function execute(Route $route);
}
