<?php
namespace TShirtADay\Votes\Domain\Model\TShirt;

use PHPUnit_Framework_TestCase;

class TShirtIdTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function equals_return_true_if_TShirtId_are_the_same()
    {
        $tid1 = $tid2 = new TShirtId(12345);
        $this->assertTrue($tid1->equals($tid2));
    }

    /**
     * @test
     */
    public function equals_return_false_if_TShirtId_are_the_same()
    {
        $tid1 = new TShirtId(12345);
        $tid2 = new TShirtId(00000);
        $this->assertFalse($tid1->equals($tid2));
    }

    /**
     * @test
     */
    public function toNative_return_native_value()
    {
        $tid = new TShirtId(12345);
        $this->assertEquals(12345, $tid->toNative());
    }

    /**
     * @test
     */
    public function toString_return_native_value()
    {
        $tid = new TShirtId(12345);
        $this->assertEquals(12345, (string) $tid);
    }

}