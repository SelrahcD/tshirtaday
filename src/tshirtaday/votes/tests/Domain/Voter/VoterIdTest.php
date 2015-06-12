<?php
namespace TShirtADay\Votes\Domain\Voter;

class VoterIdTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function equals_return_true_if_VoterId_are_the_same()
    {
        $vid1 = $vid2 = new VoterId('id');
        $this->assertTrue($vid1->equals($vid2));
    }

    /**
     * @test
     */
    public function equals_return_false_if_VoterId_are_different()
    {
        $vid1 = new VoterId('id');
        $vid2 = new VoterId('OtherId');
        $this->assertFalse($vid1->equals($vid2));
    }

}