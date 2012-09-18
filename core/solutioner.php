<?php

namespace core;


class Solutioner {

    private $solution_dir;
    
    private $config_file;
    
    private $solution_file;
    
    private $solution;
    
    private $configurator;
    
    public function  __construct($solution, $solution_dir) {
        $this->solution = $solution;
        $this->solution_dir = $solution_dir;
    }
    
    public function solutionDir($solution_dir) {
        return $this->solution_dir;
    }
    
    public function attachConfigurator($configurator) {
        $this->configurator = $configurator;
    }
    
    public function setConfigFile() {
        $this->config_file = $this->solution_dir.'/'.$this->solution.'.yml';
    }
    
    public function setSolutionFile() {
        $this->solution_file = $this->solution_dir.'/'.$this->solution.'.php';
    }
    
    public function configFile() {
        if (!$this->config_file) {
            $this->setConfigFile();
        }
        return $this->config_file;
    }
    
    public function solutionFile() {
        if (!$this->solution_file) {
            $this->setSolutionFile();
        }
        return $this->solution_file;
    }
    
    public function load() {
        if (!file_exists($this->solutionFile())) {
            throw new \Exception("Solution file doesn't exists:".$this->solutionFile());
        }
        require_once $this->solutionFile();
        echo "Solution Loaded";
    }
    /*
    public function resolveDataIn() {
        $datas = $this->solutionData["datas"];
        foreach ($datas as $route => $data) {
            $dataKeys = array_keys($data);
            if ($this->dataBag->find($dataKey)) {
                $this->route = $route;
                $this->data = $data;
                $this->resolveFilters();
                $this->resolveValider();
                $this->resolveTransformer();
                break;
            }
        }
    }
    */
    
    
}

?>