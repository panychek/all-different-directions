<?php

namespace Panychek\AllDifferentDirections\Domain\Instruction;

use Zend\ServiceManager\AbstractPluginManager;

class InstructionPluginManager extends AbstractPluginManager
{
    protected $instanceOf = ExecutableInstructionInterface::class;
}
