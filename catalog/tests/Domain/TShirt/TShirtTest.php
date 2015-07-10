<?php
namespace TShirtADay\Catalog\Domain\TShirt;

use PHPUnit_Framework_TestCase;

class TShirtTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function withDescription_return_a_TShirt()
    {
        $tshirt = TShirt::withDescription('Description');
        $this->assertInstanceOf('TShirtADay\Catalog\Domain\TShirt\TShirt', $tshirt);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function withDescription_throw_InvalidArgumentException_if_description_is_not_a_string()
    {
        TShirt::withDescription(1);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function withDescription_throw_InvalidArgumentException_if_description_is_empty_string()
    {
        TShirt::withDescription('');
    }

    /**
     * @test
     */
    public function is_return_true_if_TShirt_is_the_one()
    {
        $tshirt = new TShirt(new TShirtId(12345), 'Dummy description');
        $this->assertTrue($tshirt->is(new TShirtId(12345)));
    }

    /**
     * @test
     */
    public function is_return_false_if_TShirt_is_not_the_one()
    {
        $tshirt = new TShirt(new TShirtId(12345), 'Dummy description');
        $this->assertFalse($tshirt->is(new TShirtId(0000)));
    }

}