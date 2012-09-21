<?php
namespace core;

class TalLoader implements  ViewInterface {

    private $renderer;
    
    public function __construct($renderer) {
        $this->renderer = $renderer;
    }
    
    public function attachTemplate($template_file) {
        $this->renderer->setTemplate($template_file);
    }
    
    public function getRenderer() {
        return $this->renderer;
    }
    
    public function render() {
        return $this->renderer->execute();
    }
}

?>