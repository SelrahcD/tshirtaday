<?php

use TShirtADay\Catalog\Domain\Commands\AddTShirtToCatalogCommand;
use TShirtADay\Catalog\Domain\Commands\Handlers\AddTShirtToCatalogHandler;

class AddTShirtToCatalogHandlerTest extends PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        $this->catalog = \Mockery::mock('TShirtADay\Catalog\Domain\Model\Catalog\Catalog');
        $this->handler = new AddTShirtToCatalogHandler($this->catalog);
    }

    protected function tearDown()
    {
        \Mockery::close();
    }

    /**
    * @test
    */
    public function it_should_add_a_tshirt_to_the_catalog()
    {
        $this->catalog->shouldReceive('add')->once();
        $this->handler->handle(new AddTShirtToCatalogCommand('A dummy description'));
    }
}