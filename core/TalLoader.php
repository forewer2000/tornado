<?php

namespace core;

class TalLoader implements  ViewInterface{


    private $renderer;
    
    public function __construct() {
    }
    
    public function loadRenderer() {
        //require_once $this->tal_dir.'/PHPTAL.php';
        $this->renderer = new \PHPTAL($this->template_file);
    }
    
    public function attachTemplate($template_file) {
        $this->template_file = $template_file;
    }
    
    public function renderer() {
        return $this->renderer;
    }
    
    public function render() {
        return $this->renderer->execute();
    }
}

?>