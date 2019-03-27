<?php

namespace Panychek\AllDifferentDirections\Domain\Instruction;

abstract class AbstractInstruction
{
    /**
     * @var float The number associated with the instruction, e.g. angle degrees
     */
    protected $num;

    /**
     * @param float $num
     */
    public function __construct(float $num)
    {
        $this->setNumber($num);
    }

    /**
     * @param float $num
     */
    private function setNumber(float $num)
    {
        $this->num = $num;
    }
}
