<?php
namespace TShirtADay\Catalog\Domain\Model\Admin;

use Buttercup\Protects\RecordsEvents;
use Buttercup\Protects\DomainEvent;
use Buttercup\Protects\DomainEvents;
use TShirtADay\Catalog\Domain\Model\Catalog\Catalog;
use TShirtADay\Catalog\Domain\Model\TShirt\TShirt;
use TShirtADay\Catalog\Domain\Model\TShirt\TShirtId;
use TShirtADay\Catalog\Domain\Model\TShirt\TShirtWasAddedToCatalog;
use TShirtADay\Catalog\Domain\Model\TShirt\TShirtWasRemovedFromCatalog;

class Admin implements RecordsEvents {

     /**
     * @var DomainEvent[]
     */
    private $latestRecordedEvents = [];
    
    public function addTShirtWithDescriptionToCatalog($description, Catalog $catalog)
    {
        $tshirt = TShirt::withDescription($description);

        $catalog->add($tshirt);

        $this->recordThat(new TShirtWasAddedToCatalog($tshirt->id()));
    }

    public function removeTShirtWithIdFromCatalog(TShirtId $id, Catalog $catalog)
    {
        $catalog->remove($id);

        $this->recordThat(new TShirtWasRemovedFromCatalog($id));
    }

    public function getRecordedEvents()
    {
        return new DomainEvents($this->latestRecordedEvents);
    }

    public function clearRecordedEvents()
    {
        $this->latestRecordedEvents = [];
    }

    private function recordThat(DomainEvent $domainEvent)
    {
        $this->latestRecordedEvents[] = $domainEvent;
    }
}