<?php
namespace TShirtADay\Votes\Domain\Clock;

class Clock {
    
    public function today()
    {
        return new \DateTimeImmutable;
    }
}