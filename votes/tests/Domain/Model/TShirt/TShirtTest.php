<?php
namespace TShirtADay\Votes\Domain\Model\TShirt;


class TShirtTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function a_newly_created_tshirt_should_not_have_been_elected()
    {
        $tshirt = new TShirt(new TShirtid('tid'));
        $this->assertFalse($tshirt->hasBeenElected());
    }

    /**
     * @test
     */
    public function an_elected_tshirt_is_marked_as_elected()
    {
        $tshirt = new TShirt(new TShirtid('tid'));
        $tshirt->isElected();
        $this->assertTrue($tshirt->hasBeenElected());
    }
}