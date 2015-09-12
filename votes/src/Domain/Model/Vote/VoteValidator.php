<?php
namespace TShirtADay\Votes\Domain\Model\Vote;

use TShirtADay\Votes\Domain\Model\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Model\TShirt\TShirtRepository;
use TShirtADay\Votes\Domain\Model\Voter\VoterId;
use TShirtADay\Votes\Domain\Model\VotingSession\VotingSessionRepository;
use TShirtADay\Votes\Domain\Model\Clock\Clock;

class VoteValidator
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
        return $this->voterHasNotAlreadyVotedForDay($vote->voterId(), $vote->day())
            && $this->tshirtExistsAndHasNotBeenElectedYet($vote->tshirtId())
            && $this->aVotingSessionIsOpenedForDay($vote->day());
    }

    /**
     * @param VoterId $voterId
     * @param \DateTimeImmutable $day
     * @return bool
     * @internal param Vote $vote
     */
    public function voterHasNotAlreadyVotedForDay(VoterId $voterId, \DateTimeImmutable $day)
    {
        return $this->voteRepository->voteForVoterOn($voterId, $day) === null;
    }

    /**
     * @param TShirtId $tshirtId
     * @return bool
     */
    public function tshirtExistsAndHasNotBeenElectedYet(TShirtId $tshirtId)
    {
        $tshirt = $this->tshirtRepository->withId($tshirtId);
        return $tshirt && !$tshirt->hasBeenElected();
    }

    /**
     * @param \DateTimeImmutable $day
     * @return bool
     */
    public function aVotingSessionIsOpenedForDay(\DateTimeImmutable $day)
    {
        $votingSession = $this->votingSessionRepository->sessionFor($day);
        return $votingSession && $votingSession->acceptVoteOn($this->clock->today());
    }
}