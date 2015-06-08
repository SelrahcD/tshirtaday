<?php
namespace TShirtADay\Catalog\Domain\TShirt;

use Buttercup\Protects\DomainEvent;

final class TShirtWasRemovedFromCatalog implements DomainEvent {

    private $tshirtId;

    public function __construct(TShirtId $tshirtId)
    {
        $this->tshirtId = $tshirtId;
    }

    public function getAggregateId()
    {
        return $this->tshirtId;
    }
}