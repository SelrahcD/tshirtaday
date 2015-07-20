<?php
namespace TShirtADay\Votes\Domain\Model\Vote;

use TShirtADay\Votes\Domain\Model\Voter\VoterId;
use TShirtADay\Votes\Domain\Model\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Model\TShirt\TShirt;
use TShirtADay\Votes\Domain\Model\Clock\TestClock;
use TShirtADay\Votes\Domain\Model\VotingSession\VotingSession;

class VoteValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $voteRepository;

    private $tshirtRepository;

    private $votingSessionRepository;

    private $clock;

    private $validator;

    public function setUp()
    {
        $this->voteRepository = \Mockery::mock('TShirtADay\Votes\Domain\Model\Vote\VoteRepository');
        $this->tshirtRepository = \Mockery::mock('TShirtADay\Votes\Domain\Model\TShirt\TShirtRepository');
        $this->votingSessionRepository = \Mockery::mock('TShirtADay\Votes\Domain\Model\VotingSession\VotingSessionRepository');
        $this->clock = new TestClock;
        $this->validator = new VoteValidator($this->voteRepository, $this->tshirtRepository,
            $this->votingSessionRepository, $this->clock);
    }

    public function tearDown()
    {
      \Mockery::close();
    }
    
    /**
    * @test
    */
    public function it_should_return_true_if_voter_has_not_already_voted_for_that_day_and_tshirt_has_not_been_elected_and_a_voting_session_is_opened()
    {
        $this->voterHasNotVoted();

        $this->tshirtExists('tid');

        $this->aVotingSessionForIsOpenedFromTo("13-01-1989", "10-01-1989", "12-01-1989");

        $this->todayIs('11-01-1989');

        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertTrue($this->validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_voter_already_voted_for_that_day()
    {
        $this->voterHasVotedFor('vid', '13-01-1989');

        $this->tshirtExists('tid');

        $this->aVotingSessionForIsOpenedFromTo("13-01-1989", "10-01-1989", "12-01-1989");

        $this->todayIs('11-01-1989');

        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($this->validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_tshirt_doesnt_exist()
    {
        $this->voterHasNotVoted();

        $this->tshirtDoesntExist('tid');

        $this->aVotingSessionForIsOpenedFromTo("13-01-1989", "10-01-1989", "12-01-1989");

        $this->todayIs('11-01-1989');

        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($this->validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_no_voting_session_opened()
    {
        $this->voterHasNotVoted();

        $this->tshirtExists('tid');

        $this->noVotingSessionOpenedFor('13-01-1989');

        $this->todayIs('11-01-1989');

        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($this->validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_today_is_outside_of_voting_session_opened()
    {
        $this->voterHasNotVoted();

        $this->tshirtExists('tid');

        $this->aVotingSessionForIsOpenedFromTo("13-01-1989", "10-01-1989", "12-01-1989");

        $this->todayIs('11-12-1989');

        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($this->validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_tshirt_was_already_elected()
    {
        $this->voterHasNotVoted();

        $this->tshirtExistAndHasBeenElected('tid');

        $this->aVotingSessionForIsOpenedFromTo("13-01-1989", "10-01-1989", "12-01-1989");

        $this->todayIs('10-01-1989');

        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($this->validator->isValid($vote));
    }

    private function voterHasNotVoted()
    {
        $this->voteRepository->shouldReceive('voteForVoterOn')
            ->andReturn(null);
    }

    private function tshirtExists($id)
    {
        $tid = new TShirtId($id);
        $tshirt = new TShirt($tid);
        $this->tshirtRepository->shouldReceive('withId')
            ->with(\Mockery::mustBe($tid))
            ->andReturn($tshirt);
    }

    private function tshirtExistAndHasBeenElected($id)
    {
        $tid = new TShirtId($id);
        $tshirt = new TShirt($tid);
        $tshirt->isElected();
        $this->tshirtRepository->shouldReceive('withId')
            ->with(\Mockery::mustBe($tid))
            ->andReturn($tshirt);
    }

    private function todayIs($date)
    {
        $this->clock->setToday(new \DateTimeImmutable($date));
    }

    private function aVotingSessionForIsOpenedFromTo($for, $from, $to)
    {
        $for = new \DateTimeImmutable($for);
        $votingSession = new VotingSession($for, new \DateTimeImmutable($from), new \DateTimeImmutable($to));
        $this->votingSessionRepository
            ->shouldReceive('sessionFor')
            ->with(\Mockery::mustBe($for))
            ->andReturn($votingSession);
    }

    private function voterHasVotedFor($voterId, $day)
    {
        $this->voteRepository->shouldReceive('voteForVoterOn')
            ->with(\Mockery::mustBe(new VoterId('vid')), \Mockery::mustBe(new \DateTimeImmutable('13-01-1989')))
            ->andReturn(new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989')));
    }

    private function noVotingSessionOpenedFor($day)
    {
        $this->votingSessionRepository
            ->shouldReceive('sessionFor')
            ->with(\Mockery::mustBe(new \DateTimeImmutable($day)))
            ->andReturn(null);
    }

    private function tshirtDoesntExist($tid)
    {
        $this->tshirtRepository->shouldReceive('withId')
            ->with(\Mockery::mustBe(new TShirtId($tid)))
            ->andReturn(null);
    }
}