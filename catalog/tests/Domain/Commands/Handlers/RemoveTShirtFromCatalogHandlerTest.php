<?php

namespace Domain\Commands\Handlers;


use Mockery\Mock;
use TShirtADay\Catalog\Domain\Commands\Handlers\RemoveTShirtFromCatalogHandler;
use TShirtADay\Catalog\Domain\Commands\RemoveTShirtFromCatalogCommand;
use TShirtADay\Catalog\Domain\Model\Catalog\Catalog;
use TShirtADay\Catalog\Domain\Model\TShirt\TShirtId;

class RemoveTShirtFromCatalogHandlerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Catalog
     */
    private $catalog;


    /**
     * @var RemoveTShirtFromCatalogHandler
     */
    private $handler;

    public function setUp()
    {
        $this->catalog = \Mockery::mock('TShirtADay\Catalog\Domain\Model\Catalog\Catalog');
        $this->handler = new RemoveTShirtFromCatalogHandler($this->catalog);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
    * @test
    */
    public function it_should_remove_a_tshirt_from_catalog()
    {
        $this->catalog->shouldReceive('remove')->once();
        $this->handler->handle(new RemoveTShirtFromCatalogCommand(new TShirtId('1234')));
    }
}
