<?php
    class Home  {
        public function __construct() {
        }
        
        public function index() {
            $this->view->testVariable = "This is a test variable";
        }
        
    }

?>