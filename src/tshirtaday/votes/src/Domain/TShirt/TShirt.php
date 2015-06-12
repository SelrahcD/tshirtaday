<?php
namespace TShirtADay\Votes\Domain\TShirt;

final class TShirt
{
    private $id;

    public function __construct(TShirtId $id)
    {
        $this->id = $id;
    }
}