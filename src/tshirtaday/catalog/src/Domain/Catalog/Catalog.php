<?php
namespace TShirtADay\Catalog\Domain\Catalog;

use TShirtADay\Catalog\Domain\TShirt\TShirt;
use TShirtADay\Catalog\Domain\TShirt\TShirtId;

interface Catalog {

    public function add(TShirt $tshirt);

    public function all();

    public function remove(TShirtId $id);
}