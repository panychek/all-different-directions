<?php

use Panychek\AllDifferentDirections\Command\ComputeCommand;

return [
    [
        'name' => 'compute',
        'handler' => ComputeCommand::class,
        'route' => '--file=', // [-i | --interactive]
        'short_description' => 'Solve the problem',
        'options_descriptions' => [
            '--file' => 'The path to the file that contains the input data',
        ],
    ],
];
