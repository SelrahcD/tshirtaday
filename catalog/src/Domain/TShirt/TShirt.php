<?php
namespace TShirtADay\Catalog\Domain\TShirt;

use Assert\Assertion;

class TShirt {
    
    /**
     * @var TShirtADay\Catalog\Domain\TShirt\TShirtId;
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    public function __construct(TShirtId $id, $description)
    {
        Assertion::string($description);
        Assertion::notEmpty($description);

        $this->id = $id;
        $this->description = $description;
    }

    static public function withDescription($description)
    {
        return new self(TShirtID::generate(), $description);
    }

    public function is(TShirtID $id)
    {
        return $this->id->equals($id);
    }

    public function id()
    {
        return $this->id;
    }

    public function description()
    {
        return $this->description;
    }
}