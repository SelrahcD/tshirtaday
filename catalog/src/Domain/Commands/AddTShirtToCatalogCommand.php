<?php

namespace TShirtADay\Catalog\Domain\Commands;

final class AddTShirtToCatalogCommand
{
    /**
     * @var string
     */
    private $description;

    /**
     * AddToCatalogCommand constructor.
     * @param $description
     */
    public function __construct($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

}