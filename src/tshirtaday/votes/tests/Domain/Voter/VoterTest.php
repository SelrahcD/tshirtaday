<?php
namespace TShirtADay\Votes\Domain\Voter;

use TShirtADay\Votes\Domain\TShirt\TShirtId;

class VoterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function voteForTShirtOn_should_return_a_vote()
    {
        $voter = new Voter(new VoterId(12345));
        $vote = $voter->voteForTShirtOn(new TShirtId('tid'), new \DateTimeImmutable("13-10-1989"));
        $this->assertInstanceOf('TShirtADay\Votes\Domain\Vote\Vote', $vote);
    }


}