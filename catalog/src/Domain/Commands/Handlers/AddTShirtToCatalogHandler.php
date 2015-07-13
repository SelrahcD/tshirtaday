<?php

namespace TShirtADay\Catalog\Domain\Commands\Handlers;

use TShirtADay\Catalog\Domain\Commands\AddTShirtToCatalogCommand;
use TShirtADay\Catalog\Domain\Model\Admin\Admin;
use TShirtADay\Catalog\Domain\Model\Catalog\Catalog;

final class AddTShirtToCatalogHandler
{
    /**
     * @var Catalog
     */
    private $catalog;

    /**
     * AddTShirtToCatalogHandler constructor.
     * @param $catalog
     */
    public function __construct(Catalog $catalog)
    {
        $this->catalog = $catalog;
    }


    /**
     * @param AddTShirtToCatalogCommand $command
     */
    public function handle(AddTShirtToCatalogCommand $command)
    {
        $admin = new Admin;
        $this->catalog = $this->catalog;
        $admin->addTShirtWithDescriptionToCatalog($command->description(), $this->catalog);
    }
}