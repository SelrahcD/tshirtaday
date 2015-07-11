<?php
namespace TShirtADay\Catalog\Infrastructure\Repositories\InMemory;

use TShirtADay\Catalog\Domain\Model\TShirt\TShirt;
use TShirtADay\Catalog\Domain\Model\TShirt\TShirtId;
use TShirtADay\Catalog\Domain\Model\Catalog\Catalog;

class InMemoryCatalog implements Catalog {

    private $tshirts = array();

    public function add(TShirt $tshirt)
    {
        $this->tshirts[] = $tshirt;
    }

    public function all()
    {
        return $this->tshirts;
    }

    public function remove(TShirtId $id)
    {
        $count = count($this->tshirts);
        for ($i = 0; $i < $count; $i++) {
            if($this->tshirts[$i]->is($id)) {
                unset($this->tshirts[$i]);
            }
        }
    }
}