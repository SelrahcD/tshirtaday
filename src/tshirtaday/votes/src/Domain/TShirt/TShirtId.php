<?php
namespace TShirtADay\Votes\Domain\TShirt;

class TShirtId {
    
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function equals(TShirtId $otherTshirtId)
    {
        return $this->value == $otherTshirtId->value;
    }
}