<?php

namespace Panychek\AllDifferentDirections\Validator;

use Zend\Validator\LessThan;

class TestCaseCountValidator extends LessThan
{
    public function __construct()
    {
        $options = [
            'inclusive' => true,
            'max' => 100,
        ];

        parent::__construct($options);

        $message = 'Parsing error: Too many test cases';
        $this->setMessage($message, self::NOT_LESS_INCLUSIVE);
    }
}
