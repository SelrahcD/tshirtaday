<?php
namespace TShirtADay\Votes\Domain\Vote;

use TShirtADay\Votes\Domain\TShirt\TShirtId;
use TShirtADay\Votes\Domain\Voter\VoterId;

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
}