<?php
namespace TShirtADay\Votes\Domain\Model\Clock;

class Clock {
    
    public function today()
    {
        return new \DateTimeImmutable;
    }
}