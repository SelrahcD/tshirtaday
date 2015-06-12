<?php
namespace TShirtADay\Votes\Domain\VotingSession;

use PHPUnit_Framework_TestCase;

class VotingSessionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throw_exception_if_openingDate_is_after_day()
    {
        new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("14-01-1989"), new \DateTimeImmutable("12-01-1989"));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throw_exception_if_closingDate_is_after_day()
    {
        new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("12-01-1989"), new \DateTimeImmutable("14-01-1989"));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throw_exception_if_openingDate_is_the_same_date_as_day()
    {
        new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("12-01-1989"), new \DateTimeImmutable("13-01-1989"));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throw_exception_if_closingDate_is_the_same_date_as_day()
    {
        new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("12-01-1989"), new \DateTimeImmutable("13-01-1989"));
    }


}