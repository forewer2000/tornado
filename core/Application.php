<?php
namespace core;

class Application {

    private $base_path;
    
    private $app_path;
  
    
    public function __construct($client) {
        $this->client = $client;
    }

    public function getSolution() {
        return $this->client->browserRequestGetFirstUriPart();
    }
        
    public function appPath() {
        if (!$this->app_path) {
            $this->app_path = getcwd() .'/../';
        }
        return $this->app_path;
    }
    
    public function configPath() {
        return $this->appPath() . self::CONFIG_PATH;
    }
    
    public function solutionPath() {
        return $this->appPath() . 'solutions/'. $this->getSolution();
    }
 
    public function getView() {
        return $this->appPath()."view/home.html";
    }
}

?>