<?php

use Panychek\AllDifferentDirections\Command\ComputeCommand;
use Panychek\AllDifferentDirections\Command\ComputeCommandFactory;
use Panychek\AllDifferentDirections\Command\InputParser;
use Panychek\AllDifferentDirections\Command\InputParserFactory;
use Panychek\AllDifferentDirections\Domain\Instruction\InstructionPluginManager;
use Panychek\AllDifferentDirections\Domain\Instruction\InstructionPluginManagerFactory;
use Panychek\AllDifferentDirections\Domain\Location;
use Panychek\AllDifferentDirections\Domain\LocationFactory;
use Panychek\AllDifferentDirections\Domain\ProposedRoute\Route;
use Panychek\AllDifferentDirections\Domain\ProposedRoute\RouteCollection;
use Panychek\AllDifferentDirections\Domain\ProposedRoute\RouteCollectionFactory;
use Panychek\AllDifferentDirections\Domain\ProposedRoute\RouteFactory;
use Panychek\AllDifferentDirections\Hydrator\Route\RouteEntityHydrator;
use Panychek\AllDifferentDirections\Hydrator\Route\RouteEntityHydratorFactory;
use Panychek\AllDifferentDirections\Hydrator\Route\RouteHydratorFactory;
use Panychek\AllDifferentDirections\Hydrator\Route\RouteLocationHydrator;
use Panychek\AllDifferentDirections\Hydrator\Route\RouteLocationHydratorFactory;
use Panychek\AllDifferentDirections\Hydrator\RouteIterator\RouteIteratorPluginManager;
use Panychek\AllDifferentDirections\Hydrator\RouteIterator\RouteIteratorPluginManagerFactory;
use Panychek\AllDifferentDirections\Validator\FirstInstructionValidator;
use Panychek\AllDifferentDirections\Validator\InputNumericValidator;
use Panychek\AllDifferentDirections\Validator\InstructionCountValidator;
use Panychek\AllDifferentDirections\Validator\PersonCountValidator;
use Panychek\AllDifferentDirections\Validator\TestCaseCountValidator;
use Zend\Hydrator\ReflectionHydrator;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'factories' => [
        ComputeCommand::class => ComputeCommandFactory::class,
        FirstInstructionValidator::class => InvokableFactory::class,
        InputNumericValidator::class => InvokableFactory::class,
        InputParser::class => InputParserFactory::class,
        InstructionCountValidator::class => InvokableFactory::class,
        InstructionPluginManager::class => InstructionPluginManagerFactory::class,
        Location::class => LocationFactory::class,
        PersonCountValidator::class => InvokableFactory::class,
        ReflectionHydrator::class => InvokableFactory::class,
        Route::class => RouteFactory::class,
        RouteCollection::class => RouteCollectionFactory::class,
        RouteIteratorPluginManager::class => RouteIteratorPluginManagerFactory::class,
        RouteEntityHydrator::class => RouteEntityHydratorFactory::class,
        'RouteHydrator' => RouteHydratorFactory::class,
        RouteLocationHydrator::class => RouteLocationHydratorFactory::class,
        TestCaseCountValidator::class => InvokableFactory::class,
    ],
];
