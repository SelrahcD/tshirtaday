<?php
namespace TShirtADay\Catalog\Domain\Model\TShirt;

use Buttercup\Protects\DomainEvent;

final class TShirtWasAddedToCatalog implements DomainEvent {

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