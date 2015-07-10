<?php
namespace TShirtADay\Votes\Domain\Voter;

use TShirtADay\Votes\Domain\Vote\Vote;
use TShirtADay\Votes\Domain\TShirt\TShirtId;

final class Voter {

    private $id;

    public function __construct(VoterId $id)
    {
        $this->id = $id;
    }

    public function voteForTShirtOn(TShirtId $tid, \DateTimeImmutable $day)
    {
        return new Vote($this->id, $tid, $day);
    }
}