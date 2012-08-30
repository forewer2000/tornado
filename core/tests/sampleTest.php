<?php

require_once "sample.php";

class StackTest extends PHPUnit_Framework_TestCase
{
    public function setUp() {
        $this->sample = new Sample();
    }
    
    public function testPushAndPop() {    
        $this->assertEquals(5, $this->sample->sum(2, 3));
    }

}
?>