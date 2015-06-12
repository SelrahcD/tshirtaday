<?php
namespace TShirtADay\Votes\Domain\Vote;

use TShirtADay\Votes\Domain\TShirt\TShirtId;

interface VoteRepository {
    
    public function add(Vote $vote);

    public function votesForTShirtOn(TShirtId $tshirtId, \DateTimeImmutable $day);
}