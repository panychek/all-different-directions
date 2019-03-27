<?php

namespace Panychek\AllDifferentDirections\Command;

use Interop\Container\ContainerInterface;
use Panychek\AllDifferentDirections\Validator\InputNumericValidator;
use Panychek\AllDifferentDirections\Validator\PersonCountValidator;
use Panychek\AllDifferentDirections\Validator\TestCaseCountValidator;
use Zend\ServiceManager\Factory\FactoryInterface;

class InputParserFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $testCaseCountValidator = $container->get(TestCaseCountValidator::class);

        $personCountValidator = $container->get(PersonCountValidator::class);

        $inputNumericValidator = $container->get(InputNumericValidator::class);

        return new InputParser($testCaseCountValidator, $personCountValidator, $inputNumericValidator);
    }
}
