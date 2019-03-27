<?php

namespace Panychek\AllDifferentDirections\Exception;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
    const BAD_FORMAT = 1;
    const TEST_CASE_NUM_EXCEEDED = 2;
    const PEOPLE_NUM_EXCEEDED = 3;
    const INSTRUCTION_NUM_EXCEEDED = 4;
}
