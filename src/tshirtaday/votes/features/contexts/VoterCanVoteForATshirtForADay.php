<?php

namespace TShirtADay\Votes\Features\Contexts;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use TShirtADay\Votes\Domain\Voter\Voter;
use TShirtADay\Votes\Domain\Voter\VoterId;
use TShirtADay\Votes\Infrastructure\Repositories\InMemory\InMemoryTShirtRepository;
use TShirtADay\Votes\Domain\TShirt\TShirt;
use TShirtADay\Votes\Domain\TShirt\TShirtId;
use TShirtADay\Votes\Domain\VotingSession\VotingSession;
use TShirtADay\Votes\Infrastructure\Repositories\InMemory\InMemoryVotingSessionRepository;
use TShirtADay\Votes\Infrastructure\Repositories\InMemory\InMemoryVoteRepository;
use TShirtADay\Votes\Domain\Vote\VoteValidator;
use TShirtADay\Votes\Domain\Vote\ValidationHandler;
use TShirtADay\Votes\Domain\Clock\TestClock as Clock;
/**
 * Defines application features from the specific context.
 */
class VoterCanVoteForATshirtForADay implements Context, SnippetAcceptingContext
{
    private $currentVoter;

    private $tshirtRepository;

    private $votingSessionRepository;

    private $voteRepository;

    private $voteOutcome;

    private $clock;

    public function __construct()
    {
        $this->tshirtRepository = new InMemoryTShirtRepository;
        $this->votingSessionRepository = new InMemoryVotingSessionRepository;
        $this->voteRepository = new InMemoryVoteRepository;
        $this->validationHandler = new ValidationHandler;
        $this->clock = new Clock;
    }

    /**
     * @Given that I'm logged in as Voter :voterId
     */
    public function thatIMLoggedInAsVoter($voterId)
    {
        $this->currentVoter = new Voter(new VoterId($voterId));
    }

    /**
     * @Given there is a TShirt with id :tshirtId
     */
    public function thereIsATshirtWithId($tshirtId)
    {
        $tshirt = new TShirt(new TShirtId($tshirtId));
        $this->tshirtRepository->add($tshirt);
    }

    /**
     * @Given there is a voting a session for the :date opened from :openingDate to :closingDate
     */
    public function thereIsAVotingASessionForTheOpenedFromTo($date, $openingDate, $closingDate)
    {
        $votingSession = new VotingSession(new \DateTimeImmutable($date), new \DateTimeImmutable($openingDate), new \DateTimeImmutable($closingDate));
        $this->votingSessionRepository->add($votingSession);
    }

    /**
     * @Given today is :today
     */
    public function todayIs($today)
    {
        $this->clock->setToday(new \DateTimeImmutable($today));
    }

    /**
     * @When I vote for the TShirt :tshirtId for the :day
     */
    public function iVoteForTheTshirtForThe($tshirtId, $day)
    {
        $vote = $this->currentVoter->voteForTShirtOn(new TShirtId($tshirtId), new \DateTimeImmutable($day));

        $validator = new VoteValidator($this->voteRepository, $this->tshirtRepository, $this->votingSessionRepository, $this->clock);
        
        $validator->validate($vote, $this->validationHandler);

        if(!$this->validationHandler->hasError()) {
            $this->voteRepository->add($vote);
        }
    }

    /**
     * @Then TShirt :tshirtId should have :voteCount vote for the :day
     */
    public function tshirtShouldHaveVoteForThe($tshirtId, $day, $voteCount)
    {
        \PHPUnit_Framework_Assert::assertEquals($voteCount, count($this->voteRepository->votesForTShirtOn(new TShirtId($tshirtId), new \DateTimeImmutable($day))));
    }

    /**
     * @Given voter has voted for tshirt :tid for the :day
     */
    public function voterHasVotedForTshirtForThe($tid, $day)
    {
        $vote = $this->currentVoter->voteForTShirtOn(new TShirtId($tid), new \DateTimeImmutable($day));
        $this->voteRepository->add($vote);
    }

    /**
     * @Then I should have an error :message
     */
    public function iShouldHaveAnError($message)
    {
        \PHPUnit_Framework_Assert::assertEquals($message, $this->validationHandler->getErrors()[0]);
    }

    /**
     * @Given there is a TShirt with id :tid that was elected
     */
    public function thereIsATshirtWithIdThatWasElected($tid)
    {
        $tshirt = new TShirt(new TShirtId($tid));
        $tshirt->isElected();
        $this->tshirtRepository->add($tshirt);
    }
}
