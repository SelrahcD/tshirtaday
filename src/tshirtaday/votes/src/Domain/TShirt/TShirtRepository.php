<?php
namespace TShirtADay\Votes\Domain\TShirt;

interface TShirtRepository {
    
    public function add(TShirt $tshirt);
}