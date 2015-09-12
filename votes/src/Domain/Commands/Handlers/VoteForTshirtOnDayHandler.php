<?php

namespace TShirtADay\Votes\Domain\Commands\Handlers;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use TShirtADay\Votes\Domain\Commands\VoteForTshirtOnDayCommand;
use TShirtADay\Votes\Domain\Model\Vote\ValidationHandler;
use TShirtADay\Votes\Domain\Model\Vote\VoteRepository;
use TShirtADay\Votes\Domain\Model\Vote\VoteValidator;
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
     * @var VoteValidator
     */
    private $voteValidator;

    /**
     * VoteForTshirtOnDayHandler constructor.
     * @param VoteRepository $voteRepository
     * @param VoteValidator $voteValidator
     */
    public function __construct(VoteRepository $voteRepository, VoteValidator $voteValidator)
    {
        $this->voteRepository = $voteRepository;
        $this->voteValidator = $voteValidator;
    }


    public function handle(VoteForTshirtOnDayCommand $command)
    {
        $voter = new Voter($command->voterId());

        $vote = $voter->voteForTShirtOn($command->tshirtId(), $command->day());

        if($this->voteValidator->isValid($vote)) {
            $this->voteRepository->add($vote);
        }
    }
}