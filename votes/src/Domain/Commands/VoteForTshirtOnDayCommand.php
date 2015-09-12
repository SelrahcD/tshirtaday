<?php

namespace TShirtADay\Votes\Domain\Commands;

use TShirtADay\Votes\Domain\Model\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Model\Voter\VoterId;

/**
 * Class VoteForTshirtOnDayCommand
 * @package TShirtADay\Votes\Domain\Commands
 */
final class VoteForTshirtOnDayCommand
{
    /**
     * @var VoterId
     */
    private $voterId;

    /**
     * @var TShirtId
     */
    private $tshirtId;

    /**
     * @var \DateTimeImmutable
     */
    private $day;

    /**
     * VoteForTshirtOnDay constructor.
     * @param TShirtId $tshirtId
     * @param VoterId $voterId
     * @param \DateTimeImmutable $day
     */
    public function __construct(TShirtId $tshirtId, VoterId $voterId, \DateTimeImmutable $day)
    {
        $this->tshirtId = $tshirtId;
        $this->voterId = $voterId;
        $this->day = $day;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function day()
    {
        return $this->day;
    }

    /**
     * @return VoterId
     */
    public function voterId()
    {
        return $this->voterId;
    }

    /**
     * @return TShirtId
     */
    public function tshirtId()
    {
        return $this->tshirtId;
    }

}