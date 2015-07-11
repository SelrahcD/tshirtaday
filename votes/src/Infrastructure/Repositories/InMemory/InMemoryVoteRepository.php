<?php
namespace TShirtADay\Votes\Infrastructure\Repositories\InMemory;

use TShirtADay\Votes\Domain\Model\Vote\Vote;
use TShirtADay\Votes\Domain\Model\Vote\VoteRepository;
use TShirtADay\Votes\Domain\Model\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Model\Voter\VoterId;

final class InMemoryVoteRepository implements VoteRepository {
    
    private $votes = [];

    public function add(Vote $vote)
    {
        $this->votes[] = $vote;
    }

    public function votesForTShirtOn(TShirtId $tshirtId, \DateTimeImmutable $day)
    {
        return array_filter($this->votes, function($vote) use($tshirtId, $day) {
            return $vote->isForTShirtOn($tshirtId, $day);
        });
    }

    public function voteForVoterOn(VoterId $voterId, \DateTimeImmutable $day)
    {
        $votes = array_filter($this->votes, function($vote) use($voterId, $day) {
            return $vote->isFromVoterOn($voterId, $day);
        });

        if($vote = reset($votes))
        {
            return $vote;
        }

        return null;
    }

}