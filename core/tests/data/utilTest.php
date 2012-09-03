<?php
namespace core\tests\data;

require_once "data/util.php";

class UtilTest extends \PHPUnit_Framework_TestCase
{
    public function setUp() {
        $this->sample = new \core\library\data\Util();
    }
    
    public function testStrClean() {
        $this->assertEquals('abc', $this->sample->strClean(' abc '));
        $this->assertEquals('234', $this->sample->strClean(234));
    }
    
}

?>