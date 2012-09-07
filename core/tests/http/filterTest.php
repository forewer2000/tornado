<?php

namespace core\tests\http;

use \core\library\filter\Filter;

require_once "filter/filter.php";
require_once "data/util.php";

class FilterTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
        $this->headers = new Filter();
    }
    
    public function testDataRemainsIntactOnNonexistingFilters() {
        $res = Filter::run(array(), '123456');
        $this->assertEquals('123456', $res);
        
        $res = Filter::run("", '123456');
        $this->assertEquals('123456', $res);
        
        $res = Filter::run("abcdefg", '123456');
        $this->assertEquals('123456', $res);
        
        $res = Filter::run(null, '123456');
        $this->assertEquals('123456', $res);
    }
    
    public function testSingleFilterIsWorking() {
        $res = Filter::run('trim', '   123456   ');
        $this->assertEquals('123456', $res);        

        $res = Filter::run('upper', 'test');
        $this->assertEquals('TEST', $res);

        $res = Filter::run('lower', 'TEST');
        $this->assertEquals('test', $res);
        
        $res = Filter::run('ucfirst', 'test');
        $this->assertEquals('Test', $res);
    }
    
    public function testMultipleFilterIsWorking() {
        $res = Filter::run('upper|trim', '   test   ');
        $this->assertEquals('TEST', $res);

        $res = Filter::run('upper|trim|lower|ucfirst', '   test   ');
        $this->assertEquals('Test', $res);
    }

}

?>