<?php
namespace core;

class Configurator {
    
    private $parser;
    
    private $parsed;
    
    private $config_url;
    
    private $config;
    
    private $raw_config;
    
    public function __construct($config_url) {
        
        $this->config_url   = $config_url;
        $this->loaded       = false;
        
    }
    
    
    public function addParser($parser) {
        $this->parser = $parser;
    }
    
    private function load() {
        $this->raw_config = @file_get_contents($this->config_url);
    }
    
    private function parse() {
        if (!$this->parser || !is_object($this->parser)) {
            throw new \Exception();
        }
        
        $this->config = $this->parser->parse($this->raw_config);
        $this->parsed = true;
    }
    
    
    public function find($config_key) {
        if (!$this->parsed) {
            $this->load();
            $this->parse();
        }
        
        if (!is_string($config_key)) {
            throw new \Exception();
        }
        
        if (!is_array($this->config)) {
            throw new \Exception();
        }

        if (!array_key_exists($config_key, $this->config)) {
            throw new \Exception();
        }
        return $this->config[$config_key];
    }
}


?>