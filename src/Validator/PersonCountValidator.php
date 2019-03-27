<?php

namespace Panychek\AllDifferentDirections\Validator;

use Zend\Validator\Between;

class PersonCountValidator extends Between
{
    public function __construct()
    {
        $options = [
            'inclusive' => true,
            'min' => 1,
            'max' => 20,
        ];

        parent::__construct($options);

        $message = 'Parsing error: Too many people to ask';
        $this->setMessage($message, self::NOT_BETWEEN);
    }
}
