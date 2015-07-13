<?php

namespace TShirtADay\Catalog\Domain\Commands;

use TShirtADay\Catalog\Domain\Model\TShirt\TShirtId;

final class RemoveTShirtFromCatalogCommand
{

    /**
     * @var TShirtId
     */
    private $tshirtId;

    /**
     * RemoveTShirtFromCatalogCommand constructor.
     * @param $tshirtId
     */
    public function __construct(TShirtId $tshirtId)
    {
        $this->tshirtId = $tshirtId;
    }

    /**
     * @return TShirtId
     */
    public function tshirtId()
    {
        return $this->tshirtId;
    }

}