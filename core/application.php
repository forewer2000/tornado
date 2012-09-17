<?php
namespace core;

class Application {

    private $base_path;
    
    private $config_path;
    
    private $config_file;
    
    const CONFIG_PATH = 'config/site.yml';
    
    public function __construct($index_dir) {
        $this->index_dir = $index_dir;
    }

    public function attachConfigurator($configurator) {
        $this->configurator = $configurator;
    }

    public function solution() {
        return $this->configurator->find('solution');        
    }
    
    public function path() {
        if (!$this->config_path) {
            $this->config_path = $this->index_dir .'/../';
        }
        return $this->config_path;
    }
    
    public function config() {
        return $this->config_path . self::CONFIG_PATH;
    }
}

?>