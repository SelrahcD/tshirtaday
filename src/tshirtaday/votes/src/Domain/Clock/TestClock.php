<?php
namespace TShirtADay\Votes\Domain\Clock;

use TShirtADay\Votes\Domain\Clock\Clock;

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