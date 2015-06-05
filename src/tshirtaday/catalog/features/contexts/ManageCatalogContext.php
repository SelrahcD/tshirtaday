<?php

namespace TShirtADay\Catalog\Features\Contexts;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use TShirtADay\Catalog\Infrastructure\Repositories\InMemory\InMemoryCatalog;
use TShirtADay\Catalog\Domain\Admin\Admin;
use TShirtADay\Catalog\Domain\TShirt\TShirt;
use TShirtADay\Catalog\Domain\TShirt\TShirtId;

/**
 * Defines application features from the specific context.
 */
class ManageCatalogContext implements Context, SnippetAcceptingContext
{
    private $catalog;

    public function __construct()
    {
        date_default_timezone_set('UTC');
    }

    /**
     * @Given a new catalog is created
     */
    public function aNewCatalogIsCreated()
    {
        $this->catalog = new InMemoryCatalog;
    }

    /**
     * @When an admin adds a TShirt with description :description to the catalog
     */
    public function anAdminAddsATshirtWithDescriptionToTheCatalog($description)
    {
        $admin = new Admin;
        $admin->addTShirtWithDescriptionToCatalog($description, $this->catalog);
    }

    /**
     * @Then the catalog should contain :count TShirt
     */
    public function theCatalogShouldContainTshirt($count)
    {
        \PHPUnit_Framework_Assert::assertEquals($count, count($this->catalog->all()));
    }

    /**
     * @Given a TShirt with id :id is added to the catalog
     */
    public function aTshirtWithIdIsAddedToTheCatalog($id)
    {
        $this->catalog->add(new TShirt(new TShirtId($id), 'Dummy description'));   
    }

    /**
     * @When an admin removes the TShirt with id :id from the catalog
     */
    public function anAdminRemovesTheTshirtWithIdFromTheCatalog($id)
    {
        $admin = new Admin;
        $admin->removeTShirtWithIdFromCatalog(new TShirtId($id), $this->catalog);
    }
}
