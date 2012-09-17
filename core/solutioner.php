<?php

namespace core;


class Solutioner {

    private $config_file;
    
    private $solution_file;
    
    private $solution;
    
    private $configurator;
    
    private $view;
    
    private $result;
    
    
    public function  __construct($app) {
        $this->app = $app;
    }
    
    public function solutionDir($solution_dir) {
        return $this->app->solutionPath();;
    }
    
    public function attachConfigurator($configurator) {
        $this->configurator = $configurator;
    }
    
    public function attachView($view) {
        $this->view = $view;
    }
    
    public function setConfigFile() {
        $this->config_file = $this->app->solutionPath().'/'.$this->app->solution().'.yml';
    }
    
    public function setSolutionFile() {
        $this->solution_file = $this->app->solutionPath().'/'.$this->app->solution().'.php';
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
    
    public function dispatch() {
        if (!file_exists($this->solutionFile())) {
            throw new \Exception("Solution file doesn't exists:".$this->solutionFile());
        }
        require_once $this->solutionFile();
        $solution = \ucfirst(\strtolower($this->app->solution()));
        $solution_obj = new $solution;
        
        $this->view->attachTemplate($this->app->appPath(). 'view/home.html');
        $this->view->loadRenderer();
        $solution_obj->view = $this->view->renderer();
        $solution_obj->index();
        $this->result = $this->view->render();
    }
    
    public function result() {
        return $this->result;
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