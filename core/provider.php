<?php

namespace core;

class Provider {
    
    public function __construct($availableModules) {
        $this->availableModules = $availableModules;
    }
    
    public function get($module) {
        if (!is_string($module)) {
            throw new \Exception();
        }
        
        if (!in_array($module, $this->availableModules)) {
            throw new \Exception();
        }
        
        if (!class_exists($module)) {
            throw new \Exception();
        }
        
        return new ${module};
    }
}

?>