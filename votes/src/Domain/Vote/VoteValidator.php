<?php
namespace TShirtADay\Votes\Domain\Vote;

use TShirtADay\Votes\Domain\TShirt\TShirtRepository;
use TShirtADay\Votes\Domain\VotingSession\VotingSessionRepository;
use TShirtADay\Votes\Domain\Clock\Clock;

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

    public function validate(Vote $vote, ValidationHandler $validationHandler)
    {
        $tshirt = $this->tshirtRepository->withId($vote->tshirtId());
        $votingSession = $this->votingSessionRepository->sessionFor($vote->day());

        if($this->voteRepository->voteForVoterOn($vote->voterId(), $vote->day()) !== null)
        {
            $validationHandler->handleError('Voter already voted for that day.');
        }

        if(!$tshirt)
        {
            $validationHandler->handleError(sprintf('TShirt %s doesnt exist', $vote->tshirtId()));
        }

        if($tshirt && $tshirt->hasBeenElected())
        {
            $validationHandler->handleError(sprintf('TShirt %s was already elected', $vote->tshirtId()));
        }

        if(!$votingSession)
        {
            $validationHandler->handleError(sprintf('No voting session opened for the %s', $vote->day()->format('d-m-Y')));
        }

        if($votingSession && !$votingSession->acceptVoteOn($this->clock->today()))
        {
            $validationHandler->handleError(sprintf('No voting session opened for the %s', $vote->day()->format('d-m-Y')));
        }
    }
}