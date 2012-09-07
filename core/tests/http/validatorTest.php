<?php

namespace core\tests\http;

use \core\library\validator\Validator;

require_once "validator/validator.php";
require_once "data/util.php";

class FilterTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
    }
    
    public function testThereIsNoErrorsOnNonexistingValidator() {
        $this->assertEquals(array(), Validator::run(null, "test"));
        
        $this->assertEquals(array(), Validator::run("", "test"));
        
        $this->assertEquals(array(), Validator::run("abcdef", "test"));
        
        $this->assertEquals(array(), Validator::run("abcdef|ghijk", "test"));
    
    }

    public function testSingleValidator() {
        $this->assertEquals(array(), Validator::run("string", "test"));

        $validatorRes = Validator::run("string", array());
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(1, count($validatorRes));
        $this->assertEquals(true, is_object($validatorRes[0]));
        $this->assertEquals('string', $validatorRes[0]->getMessage());

        $validatorRes = Validator::run("number", array());
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(1, count($validatorRes));
        $this->assertEquals(true, is_object($validatorRes[0]));
        $this->assertEquals('number', $validatorRes[0]->getMessage());
 
        $validatorRes = Validator::run("min:30", array());
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(1, count($validatorRes));
        $this->assertEquals(true, is_object($validatorRes[0]));
        $this->assertEquals('number', $validatorRes[0]->getMessage());
        
        $validatorRes = Validator::run("min:30", 20);
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(1, count($validatorRes));
        $this->assertEquals(true, is_object($validatorRes[0]));
        $this->assertEquals('min', $validatorRes[0]->getMessage());
                
        $validatorRes = Validator::run("min:10", 20);
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(0, count($validatorRes));

        $validatorRes = Validator::run("max:30", array());
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(1, count($validatorRes));
        $this->assertEquals(true, is_object($validatorRes[0]));
        $this->assertEquals('number', $validatorRes[0]->getMessage());
        
        $validatorRes = Validator::run("max:30", 50);
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(1, count($validatorRes));
        $this->assertEquals(true, is_object($validatorRes[0]));
        $this->assertEquals('max', $validatorRes[0]->getMessage());
                
        $validatorRes = Validator::run("max:30", 10);
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(0, count($validatorRes));

   }
  
    public function testMultipleValidation() {
        $validatorRes = Validator::run("max:30|min:10", 15);
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(0, count($validatorRes));
        
        $validatorRes = Validator::run("max:30|min:10|string", 15);
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(1, count($validatorRes));
        $this->assertEquals(true, is_object($validatorRes[0]));
        $this->assertEquals('string', $validatorRes[0]->getMessage());
        
        $validatorRes = Validator::run("max:30|min:10|string", 0);
        $this->assertEquals(true, is_array($validatorRes));
        $this->assertEquals(2, count($validatorRes));
        $this->assertEquals('min', $validatorRes[0]->getMessage());
        $this->assertEquals('string', $validatorRes[1]->getMessage());
    }
}

?>