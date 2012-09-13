<?php

class Configurator {
    
    private $parser;
    
    private $loaded;
    
    private $config_url;
    
    
    public function __construct($config_url) {
        
        $this->config_url   = $config_url;
        $this->loaded       = false;
        
    }
    
    
    public function addParser($parser) {
        $this->parser = $parser;
    }
    
    private function load() {
        if (!$this->parser || !is_object($this->parser)) {
            throw new Exception();
        }
        
        $this->parsed = $this->parser->parse($this->config_url);
        $this->loaded = true;
    }
    
    
    public function find($config_pattern) {
        if (!$this->loaded) {
            $this->load();
        }
        ...find...
    }
}


?>