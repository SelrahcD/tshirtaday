<?php
namespace TShirtADay\Catalog\Domain\Model\Catalog;

use TShirtADay\Catalog\Domain\Model\TShirt\TShirt;
use TShirtADay\Catalog\Domain\Model\TShirt\TShirtId;

interface Catalog {

    public function add(TShirt $tshirt);

    public function all();

    public function remove(TShirtId $id);
}