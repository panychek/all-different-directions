<?php

namespace Panychek\AllDifferentDirections\Validator;

use Panychek\AllDifferentDirections\Domain\Instruction\StartInstruction;
use Zend\Validator\IsInstanceOf;

class FirstInstructionValidator extends IsInstanceOf
{
    public function __construct()
    {
        $options = [
            'className' => StartInstruction::class
        ];

        parent::__construct($options);

        $message = 'Start instruction not found';
        $this->setMessage($message, self::NOT_INSTANCE_OF);
    }
}
