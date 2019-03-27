<?php

namespace Panychek\AllDifferentDirections\Command;

use Panychek\AllDifferentDirections\Exception\InvalidArgumentException;
use Panychek\AllDifferentDirections\Exception\NotFoundResourceException;
use Panychek\AllDifferentDirections\Validator\InputNumericValidator;
use Panychek\AllDifferentDirections\Validator\PersonCountValidator;
use Panychek\AllDifferentDirections\Validator\TestCaseCountValidator;
use RuntimeException;
use SplFileObject;

/**
 * Parses the input file and partially validates its data
 * The rest of the validation belongs to the domain object
 */
class InputParser
{
    const DELIMITER = ' ';

    /**
     * @var TestCaseCountValidator
     */
    private $testCaseCountValidator;

    /**
     * @var PersonCountValidator
     */
    private $personCountValidator;

    /**
     * @var SplFileObject|null
     */
    private $file;

    /**
     * @param TestCaseCountValidator $testCaseCountValidator
     * @param PersonCountValidator $personCountValidator
     * @param InputNumericValidator $inputNumericValidator
     */
    public function __construct(
        TestCaseCountValidator $testCaseCountValidator,
        PersonCountValidator $personCountValidator,
        InputNumericValidator $inputNumericValidator
    ) {
        $this->testCaseCountValidator = $testCaseCountValidator;
        $this->personCountValidator = $personCountValidator;
        $this->inputNumericValidator = $inputNumericValidator;
    }

    /**
     * @return array
     */
    public function getFromFile(string $filePath): array
    {
        $this->setFile($filePath);

        $data = [];

        while (true) {
            if (!$this->testCaseCountValidator->isValid(count($data))) {
                $message = current($this->testCaseCountValidator->getMessages());
                throw new InvalidArgumentException($message, InvalidArgumentException::TEST_CASE_NUM_EXCEEDED);
            }

            $routes = [];

            $personCount = (int)$this->file->fgets();

            if ($this->isEndReached($personCount)) {
                break;
            }

            if (!$this->personCountValidator->isValid($personCount)) {
                $message = current($this->personCountValidator->getMessages());
                throw new InvalidArgumentException($message, InvalidArgumentException::PEOPLE_NUM_EXCEEDED);
            }

            for ($i = 0; $i < $personCount; $i++) {
                $line = $this->file->fgets();
                $routes[] = $this->getParsedRouteLine($line);
            }

            $data[] = $routes;
        }

        return $data;
    }

    /**
     * @param string $filePath
     */
    private function setFile($filePath)
    {
        try {
            $this->file = new SplFileObject($filePath);

        } catch (RuntimeException $e) {
            $message = sprintf('Error opening file "%s"', $filePath);
            throw new NotFoundResourceException($message, 0, $e);
        }
    }

    /**
     * @param string $line
     * @return array
     */
    private function getParsedRouteLine(string $line): array
    {
        $parts = explode(self::DELIMITER, $line);
        $pairs = array_chunk($parts, 2);

        // Location part
        $location = [];
        [$location['x'], $location['y']] = $pairs[0];
        array_walk($location, [$this, 'castToFloat']);

        // Instructions part
        $instructions = [];
        $instructionsSlice = array_slice($pairs, 1);
        foreach ($instructionsSlice as $pair) {
            $this->castToFloat($pair[1]);
            [$instruction['command'], $instruction['num']] = $pair;
            $instructions[] = $instruction;
        }

        return [
            'location' => $location,
            'instructions' => $instructions,
        ];
    }

    /**
     * @param $value
     */
    private function castToFloat(&$value)
    {
        $value = trim($value);

        if (!$this->inputNumericValidator->isValid($value)) {
            $message = current($this->inputNumericValidator->getMessages());
            throw new InvalidArgumentException($message, InvalidArgumentException::BAD_FORMAT);
        }

        $value = floatval($value);
    }

    /**
     * @param $num
     * @return bool
     */
    private function isEndReached($num): bool
    {
        return ($num == 0);
    }
}
