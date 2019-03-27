<?php

namespace Panychek\AllDifferentDirections\Hydrator\RouteIterator;

use Zend\Hydrator\Iterator\HydratingArrayIterator;
use Zend\ServiceManager\AbstractPluginManager;

class RouteIteratorPluginManager extends AbstractPluginManager
{
    protected $instanceOf = HydratingArrayIterator::class;
}
