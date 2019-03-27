<?php

namespace Panychek\AllDifferentDirections\Domain\ProposedRoute;

use Panychek\AllDifferentDirections\Domain\Instruction\ExecutableInstructionInterface;
use Panychek\AllDifferentDirections\Domain\Location;
use Panychek\AllDifferentDirections\Exception\InvalidArgumentException;
use Panychek\AllDifferentDirections\Validator\FirstInstructionValidator;
use Panychek\AllDifferentDirections\Validator\InstructionCountValidator;

/**
 * Represents a theoretical route plan that's been proposed to the questioner
 */
class Route
{
    /**
     * @var Location
     */
    private $currentLocation;

    /**
     * @var FirstInstructionValidator
     */
    private $firstInstructionValidator;

    /**
     * @var InstructionCountValidator
     */
    private $instructionCountValidator;

    /**
     * @var ExecutableInstructionInterface[]
     */
    private $instructions = [];

    /**
     * Which side are we looking at?
     *
     * @var int|null
     */
    private $angle;

    /**
     * @var bool
     */
    private $completed = false;

    /**
     * @param Location $currentLocation
     * @param FirstInstructionValidator $firstInstructionValidator
     * @param InstructionCountValidator $instructionCountValidator
     */
    public function __construct(
        Location $currentLocation,
        FirstInstructionValidator $firstInstructionValidator,
        InstructionCountValidator $instructionCountValidator
    ) {
        $this->currentLocation = $currentLocation;
        $this->firstInstructionValidator = $firstInstructionValidator;
        $this->instructionCountValidator = $instructionCountValidator;
    }

    /**
     * @param Location $currentLocation
     */
    public function setCurrentLocation($currentLocation)
    {
        $this->currentLocation = $currentLocation;
    }

    /**
     * @return Location
     */
    public function getCurrentLocation(): Location
    {
        return $this->currentLocation;
    }

    /**
     * @return int|null
     */
    public function getAngle(): ?int
    {
        return $this->angle;
    }

    /**
     * @param int|null $angle
     */
    public function setAngle($angle)
    {
        $this->angle = $angle;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->completed;
    }

    private function complete()
    {
        $this->completed = true;
    }

    public function calculate()
    {
        if ($this->isCompleted()) { // already calculated
            return;
        }

        /** @var ExecutableInstructionInterface $instruction */
        foreach ($this->getInstructions() as $instruction) {
            $instruction->execute($this);
        }

        $this->complete();
    }

    /**
     * @param ExecutableInstructionInterface $instruction
     */
    public function addInstruction(ExecutableInstructionInterface $instruction)
    {
        $this->assertNewInstructionAllowed($instruction);
        $this->instructions[] = $instruction;
    }

    /**
     * @param ExecutableInstructionInterface $instruction
     */
    public function assertNewInstructionAllowed(ExecutableInstructionInterface $instruction)
    {
        if (count($this->instructions) == 0) {
            if (!$this->firstInstructionValidator->isValid($instruction)) {
                $message = current($this->firstInstructionValidator->getMessages());
                throw new InvalidArgumentException($message, InvalidArgumentException::BAD_FORMAT);
            }
        }

        if (!$this->instructionCountValidator->isValid(count($this->instructions))) {
            $message = current($this->instructionCountValidator->getMessages());
            throw new InvalidArgumentException($message, InvalidArgumentException::INSTRUCTION_NUM_EXCEEDED);
        }
    }

    /**
     * @return array
     */
    public function getInstructions(): array
    {
        return $this->instructions;
    }

    public function __clone()
    {
        $this->setCurrentLocation(new Location(0, 0));
    }
}
