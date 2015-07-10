<?php
namespace TShirtADay\Votes\Domain\TShirt;

final class TShirt
{
    private $id;

    private $isElected = false;

    public function __construct(TShirtId $id)
    {
        $this->id = $id;
    }

    public function hasBeenElected()
    {
        return $this->isElected;
    }

    public function isElected()
    {
        $this->isElected = true;
    }

    public function id()
    {
        return $this->id;
    }
}