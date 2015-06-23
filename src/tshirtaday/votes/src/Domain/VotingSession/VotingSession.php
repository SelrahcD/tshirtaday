<?php
namespace TShirtADay\Votes\Domain\VotingSession;

use Assert\Assertion;

final class VotingSession
{
    private $day;

    private $openingDate;

    private $closingDate;

    public function __construct(\DateTimeImmutable $day, \DateTimeImmutable $openingDate, \DateTimeImmutable $closingDate)
    {
        $this->assertDatesAreCoherent($day, $openingDate, $closingDate);

        $this->day = $day;
        $this->openingDate = $openingDate;
        $this->closingDate = $closingDate;
    }

    public function acceptVoteOn(\DateTimeImmutable $date)
    {
        return $date < $this->closingDate
            && $date >= $this->openingDate;
    }

    public function isFor(\DateTimeImmutable $date)
    {
        return $this->day == $date;
    }

    private function assertDatesAreCoherent(\DateTimeImmutable $day, \DateTimeImmutable $openingDate, \DateTimeImmutable $closingDate)
    {
        if($openingDate >= $day) {
            throw new \InvalidArgumentException('Opening date must be before day');
        }

        if($closingDate >= $day) {
            throw new \InvalidArgumentException('Closing date must be before day');
        }
    }
}