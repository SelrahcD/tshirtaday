<?php
namespace TShirtADay\Votes\Domain\Model\Clock;

class TestClock extends Clock {
    
    private $today;

    public function today()
    {
        return $this->today;
    }

    public function setToday(\DateTimeImmutable $today)
    {
        $this->today = $today;
    }
}