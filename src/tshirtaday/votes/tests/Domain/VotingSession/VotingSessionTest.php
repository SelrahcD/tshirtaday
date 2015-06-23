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

    /**
     * @test
     */
    public function acceptVoteOn_return_true_if_date_is_between_opening_and_closing_date()
    {
        $session = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->assertTrue($session->acceptVoteOn(new \DateTimeImmutable("10-01-1989")));
    }

    /**
     * @test
     */
    public function acceptVoteOn_return_false_if_date_after_closing_date()
    {
        $session = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->assertFalse($session->acceptVoteOn(new \DateTimeImmutable("13-01-1989")));
    }

    /**
     * @test
     */
    public function acceptVoteOn_return_false_if_date_is_before_opening_date()
    {
        $session = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->assertFalse($session->acceptVoteOn(new \DateTimeImmutable("09-01-1989")));
    }

    /**
     * @test
     */
    public function isFor_return_true_if_days_are_matching()
    {
        $session = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->assertTrue($session->isFor(new \DateTimeImmutable('13-01-1989')));
    }

    /**
     * @test
     */
    public function isFor_return_false_if_days_are_matching()
    {
        $session = new VotingSession(new \DateTimeImmutable("13-01-1989"), new \DateTimeImmutable("10-01-1989"), new \DateTimeImmutable("12-01-1989"));
        $this->assertFalse($session->isFor(new \DateTimeImmutable('13-01-2000')));
    }

}