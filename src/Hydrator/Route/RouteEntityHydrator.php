<?php

namespace Panychek\AllDifferentDirections\Hydrator\Route;

use Panychek\AllDifferentDirections\Domain\Instruction\ExecutableInstructionInterface;
use Panychek\AllDifferentDirections\Domain\Instruction\InstructionPluginManager;
use Panychek\AllDifferentDirections\Domain\ProposedRoute\Route;
use Panychek\AllDifferentDirections\Exception\InvalidArgumentException;
use Zend\Hydrator\AbstractHydrator;
use Zend\Hydrator\ReflectionHydrator;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

class RouteEntityHydrator extends AbstractHydrator
{
    /**
     * @var ReflectionHydrator
     */
    private $reflectionHydrator;

    /**
     * @var InstructionPluginManager
     */
    private $instructionManager;

    /**
     * @param ReflectionHydrator $reflectionHydrator
     * @param InstructionPluginManager $instructionManager
     */
    public function __construct(
        ReflectionHydrator $reflectionHydrator,
        InstructionPluginManager $instructionManager
    ) {
        $this->reflectionHydrator = $reflectionHydrator;
        $this->instructionManager = $instructionManager;
    }

    /**
     * {@inheritDoc}
     */
    public function extract(object $object): array
    {
        if (!$object instanceof Route) {
            return [];
        }

        $data = [];

        foreach ($object->getInstructions() as $instruction) {
            $instructionData = $this->reflectionHydrator->extract($instruction);
            $instructionData['command'] = $instruction::COMMAND;

            $data['instructions'][] = $instructionData;
        }

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

        foreach ($data['instructions'] as $instructionArgs) {
            $options = [
                'num' => $instructionArgs['num']
            ];

            /** @var ExecutableInstructionInterface $instruction */
            try {
                $instruction = $this->instructionManager->get($instructionArgs['command'], $options);

            } catch (ServiceNotFoundException $e) {
                $message = 'Unknown command: ' . $instructionArgs['command'];
                throw new InvalidArgumentException($message, InvalidArgumentException::BAD_FORMAT, $e);
            }

            $object->addInstruction($instruction);
        }

        return $object;
    }
}
