<?php

namespace TShirtADay\Votes\Domain\Commands\Handlers;


use Doctrine\Instantiator\Exception\InvalidArgumentException;
use TShirtADay\Votes\Domain\Commands\VoteForTshirtOnDayCommand;
use TShirtADay\Votes\Domain\Model\Clock\Clock;
use TShirtADay\Votes\Domain\Model\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Model\TShirt\TShirtRepository;
use TShirtADay\Votes\Domain\Model\Vote\VoteRepository;
use TShirtADay\Votes\Domain\Model\Vote\VoteIsValidSpecification;
use TShirtADay\Votes\Domain\Model\Voter\VoterId;
use TShirtADay\Votes\Domain\Model\VotingSession\VotingSessionRepository;

class VoteForTshirtOnDayHandlerTest extends \PHPUnit_Framework_TestCase
{
    private $voteRepository;

    /**
     * @var VoteForTshirtOnDayHandler
     */
    private $handler;

    /**
     * @var VoteIsValidSpecification
     */
    private $voteIsValidSpecification;

    protected function setUp()
    {
        $this->voteRepository = \Mockery::mock(VoteRepository::class);
        $this->voteIsValidSpecification = \Mockery::mock(VoteIsValidSpecification::class);
        $this->handler = new VoteForTshirtOnDayHandler($this->voteRepository, $this->voteIsValidSpecification);
    }

    protected function tearDown()
    {
        \Mockery::close();
    }

    /**
    * @test
    */
    public function it_should_store_a_vote_if_vote_is_valid()
    {
        $command = new VoteForTshirtOnDayCommand(new TShirtId(1), new VoterId(1), new \DateTimeImmutable());

        $this->isAValidVote();

        $this->voteRepository->shouldReceive('add')->once();

        $this->handler->handle($command);
    }

    /**
    * @test
    */
    public function it_should_not_store_a_new_vote_if_vote_is_not_valid()
    {
        $command = new VoteForTshirtOnDayCommand(new TShirtId(1), new VoterId(1), new \DateTimeImmutable());

        $this->isNotAValidVote();

        $this->voteRepository->shouldReceive('add')->times(0);

        $this->handler->handle($command);
    }

    private function isAValidVote()
    {
        $this->voteIsValidSpecification->shouldReceive('isSatisfiedBy')->andReturn(true);
    }

    private function isNotAValidVote()
    {
        $this->voteIsValidSpecification->shouldReceive('isSatisfiedBy')->andReturn(false);
    }
}
