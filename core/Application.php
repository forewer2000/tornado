<?php
namespace core;

class Application {

    public function __construct($client) {
        $this->client = $client;
    }

    public function appPath() {
        if (!property_exists($this, 'app_path')) {
            $this->app_path = getcwd() .'/../';
        }
        return $this->app_path;
    }
    
    public function getSolutionName() {
        return $this->client->browserRequestGetFirstUriPart();
    }
    
    public function getSolutionPath() {
        return $this->appPath() . 'solutions/'. $this->getSolutionName();
    }
 
    public function getView() {
        return $this->appPath()."view/home.html";
    }
}

?>