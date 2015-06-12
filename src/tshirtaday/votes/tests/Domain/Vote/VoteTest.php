<?php
namespace TShirtADay\Votes\Domain\Vote;

use TShirtADay\Votes\Domain\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Voter\VoterId;

class VoteTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function isForTShirtOn_returns_true_if_both_day_and_tshirtId_are_matching()
    {
        $vote = new Vote(new VoterId('vid'), new TShirtId(12345), new \DateTimeImmutable("13-01-1989"));
        $this->assertTrue($vote->isForTShirtOn(new TShirtId(12345), new \DateTimeImmutable("13-01-1989")));
    }

    /**
     * @test
     */
    public function isForTShirtOn_returns_false_if_day_does_not_match()
    {
        $vote = new Vote(new VoterId('vid'), new TShirtId(12345), new \DateTimeImmutable("13-01-1989"));
        $this->assertFalse($vote->isForTShirtOn(new TShirtId(12345), new \DateTimeImmutable("13-01-2000")));
    }

    /**
     * @test
     */
    public function isForTShirtOn_returns_false_if_tshirtId_does_not_match()
    {
        $vote = new Vote(new VoterId('vid'), new TShirtId(12345), new \DateTimeImmutable("13-01-1989"));
        $this->assertFalse($vote->isForTShirtOn(new TShirtId(0000), new \DateTimeImmutable("13-01-1989")));
    }



}