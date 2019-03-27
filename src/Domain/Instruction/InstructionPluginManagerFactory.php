<?php

namespace Panychek\AllDifferentDirections\Domain\Instruction;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class InstructionPluginManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = [
            'abstract_factories' => [
                InstructionAbstractFactory::class,
            ],
        ];

        return new InstructionPluginManager($container, $config);
    }
}
