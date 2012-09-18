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

    public function addValue($key, $val) {
        try {
            $this->find($key);
            throw new \Exception();
        } catch (\Exception $e) {
            $this->config[$key] = (string)$val;
        }
    }
    
    public function addParser($parser) {
        $this->parser = $parser;
    }
    
    private function load() {
        if (!file_exists($this->config_url)) {
            throw new \Exception('file doesn\'t exists:'.$this->config_url);
        }
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
            $this->config = array();
        }

        $config_key_parts = explode('/', $config_key);
        
        $actual = $this->config;
        foreach ($config_key_parts as $cp) {
            if (!array_key_exists($cp, $actual)) {
                throw new \Exception();
            }
            $actual = $actual[$cp];
        };
        return $actual;
    }
}


?>