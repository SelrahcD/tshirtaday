<?php
namespace TShirtADay\Votes\Infrastructure\Repositories\InMemory;

use TShirtADay\Votes\Domain\Vote\Vote;
use TShirtADay\Votes\Domain\Vote\VoteRepository;
use TShirtADay\Votes\Domain\TShirt\TShirtId;

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

}