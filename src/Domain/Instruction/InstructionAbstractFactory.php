<?php

namespace Panychek\AllDifferentDirections\Domain\Instruction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class InstructionAbstractFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        $className = $this->getClassName($requestedName);
        return class_exists($className) && is_subclass_of($className, AbstractInstruction::class);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $className = $this->getClassName($requestedName);
        return new $className($options['num']);
    }

    private function getClassName(string $requestedName): string
    {
        return sprintf('%s\%sInstruction', __NAMESPACE__, ucwords($requestedName));
    }
}
