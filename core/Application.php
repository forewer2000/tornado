<?php
namespace core;

class Application {

    private $base_path;
    
    private $app_path;
    
    private $config_file;
    
    const CONFIG_PATH = 'config/site.yml';
    
    public function __construct($index_dir) {
        $this->index_dir = $index_dir;
    }

    public function attachConfigurator($configurator) {
        $this->configurator = $configurator;
    }

    public function solution() {
        $solution = $this->configurator->find('solution');
        if (!$solution) {
            $solution = $this->configurator->find('default_solution');
        }
        return $solution;
    }
    
    public function appPath() {
        if (!$this->app_path) {
            $this->app_path = $this->index_dir .'/../';
        }
        return $this->app_path;
    }
    
    public function configPath() {
        return $this->appPath() . self::CONFIG_PATH;
    }
    
    public function solutionPath() {
        return $this->appPath() . 'solutions/'. $this->solution();
    }
    
}

?>