<?php
namespace TShirtADay\Votes\Domain\Model\Voter;

class VoterId {
    
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function equals(VoterId $otherVoterId)
    {
        return $this->value === $otherVoterId->value;
    }
}