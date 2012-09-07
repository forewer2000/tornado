<?php

namespace core\tests\http;

require_once "headers/headers.php";
require_once "data/util.php";

class HttpTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
        $dataUtil = new \core\library\data\Util();
        $this->headers = new \core\library\headers\Headers($dataUtil);
    }
    
    public function testHeadersSetAndGet() {
        $this->headers->setField('Content-Type', 'img/test');
        $this->assertEquals('img/test', $this->headers->getField('Content-Type'));
    }
    
    public function testGetFullHeader() {
        $this->headers->setField('     Content-Type ', ' img/test  ');
        $this->headers->setField('  Content-Length    ', ' 123   ');
        $this->testHeader = array(
            'Content-Type: img/test',
            'Content-Length: 123'
        );
        $this->assertEquals($this->testHeader, $this->headers->getFullHeader());
    }

}

?>