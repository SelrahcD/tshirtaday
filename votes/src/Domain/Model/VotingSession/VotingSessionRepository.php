<?php
namespace TShirtADay\Votes\Domain\Model\VotingSession;

interface VotingSessionRepository {
    
    public function add(VotingSession $session);

    public function sessionFor(\DateTimeImmutable $day);
}