<?php
namespace TShirtADay\Votes\Domain\Model\Vote;

final class ValidationHandler
{
    private $errors = [];

    public function handleError($error)
    {
        $this->errors[] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasError()
    {
        return (bool) count($this->errors);
    }
}