<?php
namespace TShirtADay\Votes\Domain\Model\Vote;

use TShirtADay\Votes\Domain\Model\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Model\Voter\VoterId;

interface VoteRepository {
    
    public function add(Vote $vote);

    public function votesForTShirtOn(TShirtId $tshirtId, \DateTimeImmutable $day);

    public function voteForVoterOn(VoterId $voterId, \DateTimeImmutable $day);
}