<?php
namespace TShirtADay\Votes\Domain\Vote;

use TShirtADay\Votes\Domain\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Voter\VoterId;

interface VoteRepository {
    
    public function add(Vote $vote);

    public function votesForTShirtOn(TShirtId $tshirtId, \DateTimeImmutable $day);

    public function voteForVoterOn(VoterId $voterId, \DateTimeImmutable $day);
}