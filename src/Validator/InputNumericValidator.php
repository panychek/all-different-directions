<?php

namespace Panychek\AllDifferentDirections\Validator;

use Zend\Validator\Between;

class InputNumericValidator extends Between
{
    public function __construct()
    {
        $options = [
            'inclusive' => true,
            'min' => -1000,
            'max' => 1000,
        ];

        parent::__construct($options);

        $message = 'Invalid numeric input';
        $this->setMessage($message, self::NOT_BETWEEN);
    }
}
