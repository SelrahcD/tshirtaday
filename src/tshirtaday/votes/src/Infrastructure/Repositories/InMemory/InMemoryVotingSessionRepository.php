<?php
namespace TShirtADay\Votes\Infrastructure\Repositories\InMemory;

use TShirtADay\Votes\Domain\VotingSession\VotingSessionRepository;
use TShirtADay\Votes\Domain\VotingSession\VotingSession;

final class InMemoryVotingSessionRepository implements VotingSessionRepository {
    
    private $sessions = [];

    public function add(VotingSession $session)
    {
        $this->sessions[] = $session;
    }
}