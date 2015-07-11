<?php
namespace TShirtADay\Votes\Domain\Model\Vote;

interface VoteSpecification
{
    public function isSatisfiedBy(Vote $vote);
}