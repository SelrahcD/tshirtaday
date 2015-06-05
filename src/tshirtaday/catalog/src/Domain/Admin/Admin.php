<?php
namespace TShirtADay\Catalog\Domain\Admin;

use TShirtADay\Catalog\Domain\Catalog\Catalog;
use TShirtADay\Catalog\Domain\TShirt\TShirt;
use TShirtADay\Catalog\Domain\TShirt\TShirtId;

class Admin {
    
    public function addTShirtWithDescriptionToCatalog($description, Catalog $catalog)
    {
        $catalog->add(TShirt::withDescription($description));
    }

    public function removeTShirtWithIdFromCatalog(TShirtId $id, Catalog $catalog)
    {
        $catalog->remove($id);
    }
}