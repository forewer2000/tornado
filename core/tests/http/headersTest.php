<?php

namespace core\tests\http;

require_once "http/headers.php";
require_once "data/util.php";

class HttpTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
        $dataUtil = new \core\library\data\Util();
        $this->headers = new \core\library\http\Headers($dataUtil);
    }
    
    public function testHeadersSetAndGet() {
        $this->headers->setField('Content-Type', 'img/test');
        $this->assertEquals('img/test', $this->headers->getField('Content-Type'));
    }

}

?>