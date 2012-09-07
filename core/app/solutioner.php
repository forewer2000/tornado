<?php

namespace core\app;


class Solutioner {

    private $solutionPath;
    
    public function __construct($solutionPath) {
        $this->solutionPath = $solutionPath;
    }
    
    public function load($solution) {
        $solutionURI = $solutionPath . '/' . $solution;
        if (!file_exists($solutionURI)) {
            throw new Exception("Solution doesn't exists");
        }
        $solutionJson = file_get_contents($solutionURI);
        $this->solutionData = json_decode($solutionJson);
    }
    
    public function attachInputData($dataBag) {
        $this->dataBag = $dataBag;
    }
    
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
    
    public function resolveRoute() {
        
    }
    
    public function resolveDataOut() {
        
    }
    
    public function resolveView() {
        
    }
}

?>