<?php
namespace TShirtADay\Votes\Domain\Model\Vote;

use TShirtADay\Votes\Domain\Model\TShirt\TShirtRepository;
use TShirtADay\Votes\Domain\Model\VotingSession\VotingSessionRepository;
use TShirtADay\Votes\Domain\Model\Clock\Clock;

final class VoteValidator
{
    private $voteRepository;

    private $tshirtRepository;

    private $votingSessionRepository;

    private $clock;

    public function __construct(
        VoteRepository $voteRepository,
        TShirtRepository $tshirtRepository,
        VotingSessionRepository $votingSessionRepository,
        Clock $clock
        )
    {
        $this->voteRepository = $voteRepository;
        $this->tshirtRepository = $tshirtRepository;
        $this->votingSessionRepository = $votingSessionRepository;
        $this->clock = $clock;
    }

    public function isValid(Vote $vote)
    {
        $tshirt = $this->tshirtRepository->withId($vote->tshirtId());
        $votingSession = $this->votingSessionRepository->sessionFor($vote->day());

        if($this->voteRepository->voteForVoterOn($vote->voterId(), $vote->day()) !== null)
        {
            return false;
        }

        if(!$tshirt)
        {
            return false;
        }

        if($tshirt && $tshirt->hasBeenElected())
        {
            return false;
        }

        if(!$votingSession)
        {
            return false;
        }

        if($votingSession && !$votingSession->acceptVoteOn($this->clock->today()))
        {
            return false;
        }

        return true;
    }
}