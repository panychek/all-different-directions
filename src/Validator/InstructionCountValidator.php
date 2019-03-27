<?php

namespace Panychek\AllDifferentDirections\Validator;

use Zend\Validator\LessThan;

class InstructionCountValidator extends LessThan
{
    public function __construct()
    {
        $options = [
            'inclusive' => true,
            'max' => 25,
        ];

        parent::__construct($options);

        $message = 'Too many instructions';
        $this->setMessage($message, self::NOT_LESS_INCLUSIVE);
    }
}
