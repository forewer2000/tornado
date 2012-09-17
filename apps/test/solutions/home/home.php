<?php
    class Home  {
        public function __construct() {
        }
        
        public function index() {
            $this->view->testvar = "This is a test variable";
        }
        
    }

?>