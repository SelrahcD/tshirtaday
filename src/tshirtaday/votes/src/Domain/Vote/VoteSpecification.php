<?php
namespace TShirtADay\Votes\Domain\Vote;

interface VoteSpecification
{
    public function isSatisfiedBy(Vote $vote);
}