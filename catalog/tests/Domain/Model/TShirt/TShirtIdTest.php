<?php

use TShirtADay\Catalog\Domain\Model\TShirt\TShirtId;

class TShirtIdTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function generate_return_a_TShirtId()
    {
        $tid = TShirtId::generate();
        $this->assertInstanceOf('TShirtADay\Catalog\Domain\Model\TShirt\TShirtId', $tid);
    }

    /**
     * @test
     */
    public function equals_return_true_if_TShirtId_are_the_same()
    {
        $tid1 = $tid2 =TShirtId::generate();
        $this->assertTrue($tid1->equals($tid2));
    }

}