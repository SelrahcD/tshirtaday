<?php

use TShirtADay\Catalog\Domain\Admin\Admin;
use TShirtADay\Catalog\Domain\TShirt\TShirtId;

class AdminTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
      \Mockery::close();
    }

    /**
     * @test
     */
    public function be_able_to_add_a_tshirt_to_a_catalog()
    {
        $catalog = \Mockery::mock('TShirtADay\Catalog\Domain\Catalog\Catalog');
        $catalog->shouldReceive('add')->once()->with(\Mockery::on(function($tshirt) {
            return $tshirt->description() === 'A Fat TShirt';
        }));
        $admin = new Admin;
        $admin->addTShirtWithDescriptionToCatalog('A Fat TShirt', $catalog);
    }

    /**
     * @test
     */
    public function record_that_a_tshirt_was_added_to_the_catalog()
    {
        $catalog = \Mockery::mock('TShirtADay\Catalog\Domain\Catalog\Catalog');
        $catalog->shouldReceive('add')->once()->with(\Mockery::on(function($tshirt) {
            return $tshirt->description() === 'A Fat TShirt';
        }));
        $admin = new Admin;
        $admin->addTShirtWithDescriptionToCatalog('A Fat TShirt', $catalog);
        $this->assertInstanceOf('TShirtADay\Catalog\Domain\TShirt\TShirtWasAddedToCatalog', $admin->getRecordedEvents()[0]);
    }

    /**
     * @test
     */
    public function be_able_to_remove_a_tshirt_from_a_catalog()
    {
        $catalog = \Mockery::mock('TShirtADay\Catalog\Domain\Catalog\Catalog');
        $catalog->shouldReceive('remove')->once()->with(\Mockery::on(function($id) {
            return $id->equals(new TShirtId(12345));
        }));
        $admin = new Admin;
        $admin->removeTShirtWithIdFromCatalog(new TShirtId(12345), $catalog);
    }

    /**
     * @test
     */
    public function record_that_a_tshirt_was_removed_from_the_catalog()
    {
        $catalog = \Mockery::mock('TShirtADay\Catalog\Domain\Catalog\Catalog');
        $catalog->shouldReceive('remove')->once()->with(\Mockery::on(function($id) {
            return $id->equals(new TShirtId(12345));
        }));
        $admin = new Admin;
        $admin->removeTShirtWithIdFromCatalog(new TShirtId(12345), $catalog);

        $this->assertInstanceOf('TShirtADay\Catalog\Domain\TShirt\TShirtWasRemovedFromCatalog', $admin->getRecordedEvents()[0]);
    }
}