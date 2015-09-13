<?php

namespace TShirtADay\Votes\Domain\Commands\Handlers;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use TShirtADay\Votes\Domain\Commands\VoteForTshirtOnDayCommand;
use TShirtADay\Votes\Domain\Model\Vote\ValidationHandler;
use TShirtADay\Votes\Domain\Model\Vote\VoteRepository;
use TShirtADay\Votes\Domain\Model\Vote\VoteIsValidSpecification;
use TShirtADay\Votes\Domain\Model\Voter\Voter;

/**
 * Class VoteForTshirtOnDayHandler
 * @package TShirtADay\Votes\Domain\Commands\Handlers
 */
final class VoteForTshirtOnDayHandler
{
    /**
     * @var VoteRepository
     */
    private $voteRepository;

    /**
     * @var VoteIsValidSpecification
     */
    private $voteIsValidSpecification;

    /**
     * VoteForTshirtOnDayHandler constructor.
     * @param VoteRepository $voteRepository
     * @param VoteIsValidSpecification $voteIsValidSpecification
     */
    public function __construct(VoteRepository $voteRepository, VoteIsValidSpecification $voteIsValidSpecification)
    {
        $this->voteRepository = $voteRepository;
        $this->voteIsValidSpecification = $voteIsValidSpecification;
    }


    public function handle(VoteForTshirtOnDayCommand $command)
    {
        $voter = new Voter($command->voterId());

        $vote = $voter->voteForTShirtOn($command->tshirtId(), $command->day());

        if($this->voteIsValidSpecification->isSatisfiedBy($vote)) {
            $this->voteRepository->add($vote);
        }
    }
}