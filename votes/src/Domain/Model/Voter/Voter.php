<?php
namespace TShirtADay\Votes\Domain\Model\Voter;

use TShirtADay\Votes\Domain\Model\Vote\Vote;
use TShirtADay\Votes\Domain\Model\TShirt\TShirtId;

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

    public function id()
    {
        return $this->id;
    }
}