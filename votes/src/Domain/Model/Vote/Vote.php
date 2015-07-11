<?php
namespace TShirtADay\Votes\Domain\Model\Vote;

use TShirtADay\Votes\Domain\Model\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Model\Voter\VoterId;

final class Vote {

    private $voterId;

    private $tshirtId;

    private $day;

    public function __construct(VoterId $voterId, TShirtId $tshirtId, \DateTimeImmutable $day)
    {
        $this->voterId = $voterId;
        $this->tshirtId = $tshirtId;
        $this->day = $day;
    }

    public function isForTShirtOn(TShirtId $tid, \DateTimeImmutable $day)
    {
        return $this->tshirtId->equals($tid) && $this->day == $day;
    }

    public function isFromVoterOn(VoterId $vid, \DateTimeImmutable $day)
    {
        return $this->voterId->equals($vid) && $this->day == $day;
    }

    public function voterId()
    {
        return $this->voterId;
    }

    public function day()
    {
        return $this->day;
    }

    public function tshirtId()
    {
        return $this->tshirtId;
    }
}