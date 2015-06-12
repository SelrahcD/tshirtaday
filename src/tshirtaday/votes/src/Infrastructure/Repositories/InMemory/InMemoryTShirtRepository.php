<?php
namespace TShirtADay\Votes\Infrastructure\Repositories\InMemory;

use TShirtADay\Votes\Domain\TShirt\TShirtRepository;
use TShirtADay\Votes\Domain\TShirt\TShirt;

class InMemoryTShirtRepository implements TShirtRepository {
    
    private $tshirts = [];

    public function add(TShirt $tshirt)
    {
        $this->tshirts[] = $tshirt;
    }
}