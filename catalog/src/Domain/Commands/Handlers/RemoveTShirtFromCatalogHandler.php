<?php

namespace TShirtADay\Catalog\Domain\Commands\Handlers;

use TShirtADay\Catalog\Domain\Commands\RemoveTShirtFromCatalogCommand;
use TShirtADay\Catalog\Domain\Model\Admin\Admin;
use TShirtADay\Catalog\Domain\Model\Catalog\Catalog;

final class RemoveTShirtFromCatalogHandler
{

    /**
     * @var Catalog
     */
    private $catalog;

    /**
     * RemoveTShirtFromCatalogHandler constructor.
     * @param Catalog $catalog
     */
    public function __construct(Catalog $catalog)
    {
        $this->catalog = $catalog;
    }

    public function handle(RemoveTShirtFromCatalogCommand $command)
    {
        $admin = new Admin;
        $admin->removeTShirtWithIdFromCatalog($command->tshirtId(), $this->catalog);
    }


}