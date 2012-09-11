<?php

namespace core\tests\library;

use \core\library\Core;

require_once "core.php";

class A extends Core {
    protected function test1($args) {
        return $args;
    }
    
    private function test($args) {
        
    }
    
}

class B extends Core {
    protected function test2($args) {
        return $args;
    }
    public function __construct(A $a) {
        $this->a = $a;
    }
    
    private function test($args) {
        
    }
  
}

class C extends Core {
    protected function test3($args) {
        return $args;
    }
    
    public function __construct(B $b) {
        $this->b = $b;
    }
    
    private function test($args) {
        
    }
}


class CoreTest extends \PHPUnit_Framework_TestCase {
    
     public function setUp() {
        $this->a = new A();
        $this->b = new B($this->a);
        $this->c = new C($this->b);
    }

    /**
    * @expectedException core\library\exception\invalidCommandException
    */  
    public function testInvalidCommandException() {  
       $this->a->A();
    }

    /**
    * @expectedException core\library\exception\nonexistentCommandException
    */  
    public function testNonexistentCommandException() {  
       $this->a->abc();
    }

    /**
    * @expectedException core\library\exception\invalidSubcommandException
    */  
    public function testInvalidSubcommandException() {  
       $this->b->a_();
       $this->c->bA_();
    }
    
    /**
    * @expectedException core\library\exception\nonexistentSubcommandException
    */  
    public function testNonexistentSubcommandException() {  
       $this->b->aBoo();
       $this->c->bABoo();
    }
    
    /**
    * @expectedException core\library\exception\privateCommandException
    */  
    public function testprivateCommandCallingExceptionA() {  
       $this->a->test();
    }
    
    /**
    * @expectedException core\library\exception\privateCommandException
    */  
    public function testprivateCommandCallingExceptionB() {  
       $this->b->test();
    }

    /**
    * @expectedException core\library\exception\privateCommandException
    */  
    public function testprivateCommandCallingExceptionC() {  
       $this->b->aTest();
    }
    
    /**
    * @expectedException core\library\exception\privateCommandException
    */  
    public function testprivateCommandCallingExceptionD() {  
       $this->c->bATest();
    }
    
    public function testExistingCommandCalledWithArguments() {
        $this->assertEquals('123', $this->a->test1('123'));
    }
    
    public function testExistingSubcommandCalledWithArguments() {
        $this->assertEquals('123', $this->b->aTest1('123'));
        $this->assertEquals('123', $this->c->bATest1('123'));
        $this->assertEquals('123', $this->c->bTest2('123'));
    }
    

}

?>