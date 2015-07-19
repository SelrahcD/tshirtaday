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

    public function setUp()
    {
        $this->voteRepository = \Mockery::mock('TShirtADay\Votes\Domain\Model\Vote\VoteRepository');
        $this->tshirtRepository = \Mockery::mock('TShirtADay\Votes\Domain\Model\TShirt\TShirtRepository');
        $this->votingSessionRepository = \Mockery::mock('TShirtADay\Votes\Domain\Model\VotingSession\VotingSessionRepository');
        $this->clock = new TestClock;
    }

    public function tearDown()
    {
      \Mockery::close();
    }

    /**
     * @test
     */
    public function it_should_return_false_if_voter_already_voted_for_that_day()
    {
        $this->voteRepository->shouldReceive('voteForVoterOn')
            ->once()
            ->andReturn(new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989')));

        $tshirt = new TShirt(new TShirtId('tid'));
        $this->tshirtRepository->shouldReceive('withId')
            ->once()
            ->andReturn($tshirt);

        $votingSession = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->votingSessionRepository
            ->shouldReceive('sessionFor')
            ->once()
            ->andReturn($votingSession);

        $this->clock->setToday(new \DateTimeImmutable('11-01-1989'));

        $validator = new VoteValidator($this->voteRepository, $this->tshirtRepository, $this->votingSessionRepository, $this->clock);
        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_tshirt_doesnt_exist()
    {
        $this->voteRepository->shouldReceive('voteForVoterOn')
            ->once()
            ->andReturn(null);

        $this->tshirtRepository->shouldReceive('withId')
            ->once()
            ->andReturn(null);

        $votingSession = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->votingSessionRepository
            ->shouldReceive('sessionFor')
            ->once()
            ->andReturn($votingSession);

        $this->clock->setToday(new \DateTimeImmutable('11-01-1989'));

        $validator = new VoteValidator($this->voteRepository, $this->tshirtRepository, $this->votingSessionRepository, $this->clock);
        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_no_voting_session_opened()
    {
        $this->voteRepository->shouldReceive('voteForVoterOn')
            ->once()
            ->andReturn(null);

        $tshirt = new TShirt(new TShirtId('tid'));
        $this->tshirtRepository->shouldReceive('withId')
            ->once()
            ->andReturn($tshirt);

        $this->votingSessionRepository
            ->shouldReceive('sessionFor')
            ->once()
            ->andReturn(null);

        $this->clock->setToday(new \DateTimeImmutable('11-01-1989'));

        $validator = new VoteValidator($this->voteRepository, $this->tshirtRepository, $this->votingSessionRepository, $this->clock);
        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_today_is_outside_of_voting_session_opened()
    {
        $this->voteRepository->shouldReceive('voteForVoterOn')
            ->once()
            ->andReturn(null);

        $tshirt = new TShirt(new TShirtId('tid'));
        $this->tshirtRepository->shouldReceive('withId')
            ->once()
            ->andReturn($tshirt);

        $votingSession = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->votingSessionRepository
            ->shouldReceive('sessionFor')
            ->once()
            ->andReturn($votingSession);

        $this->clock->setToday(new \DateTimeImmutable('11-12-1989'));

        $validator = new VoteValidator($this->voteRepository, $this->tshirtRepository, $this->votingSessionRepository, $this->clock);
        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($validator->isValid($vote));
    }

    /**
     * @test
     */
    public function it_should_return_false_if_tshirt_was_already_elected()
    {
        $this->voteRepository->shouldReceive('voteForVoterOn')
            ->once()
            ->andReturn(null);

        $tshirt = new TShirt(new TShirtId('tid'));
        $tshirt->isElected();
        $this->tshirtRepository->shouldReceive('withId')
            ->once()
            ->andReturn($tshirt);

        $votingSession = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->votingSessionRepository
            ->shouldReceive('sessionFor')
            ->once()
            ->andReturn($votingSession);

        $this->clock->setToday(new \DateTimeImmutable('10-01-1989'));

        $validator = new VoteValidator($this->voteRepository, $this->tshirtRepository, $this->votingSessionRepository, $this->clock);
        $vote = new Vote(new VoterId('vid'), new TShirtId('tid'), new \DateTimeImmutable('13-01-1989'));
        $this->assertFalse($validator->isValid($vote));
    }
}