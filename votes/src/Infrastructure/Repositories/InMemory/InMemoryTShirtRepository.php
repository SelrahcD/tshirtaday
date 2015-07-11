<?php
namespace TShirtADay\Votes\Infrastructure\Repositories\InMemory;

use TShirtADay\Votes\Domain\Model\TShirt\TShirtRepository;
use TShirtADay\Votes\Domain\Model\TShirt\TShirt;
use TShirtADay\Votes\Domain\Model\TShirt\tshirtId;

final class InMemoryTShirtRepository implements TShirtRepository {
    
    private $tshirts = [];

    public function add(TShirt $tshirt)
    {
        $this->tshirts[$tshirt->id()->toNative()] = $tshirt;
    }

    public function withId(TShirtId $tshirtId)
    {
        if(isset($this->tshirts[$tshirtId->toNative()]))
        {
            return $this->tshirts[$tshirtId->toNative()];
        }

        return null;
    }
}