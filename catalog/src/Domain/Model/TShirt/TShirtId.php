<?php
namespace TShirtADay\Catalog\Domain\Model\TShirt;

use Rhumsaa\Uuid\Uuid;

class TShirtId {
    
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    static public function generate()
    {
        return new self(Uuid::uuid1());
    }

    public function equals(TShirtId $otherTshirtId)
    {
        return $this->value == $otherTshirtId->value;
    }
}