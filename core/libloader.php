<?php

namespace core;

class LibLoader {
    
    const NOT_FOUND = 'Cannot load: ';
    
    const INVALID_MODULE = 'Module list should be an array or string. Given :';
    
    
    private $libPath;
    
    public function __construct($libPath) {
        $this->libPath = $libPath;
    }
    
    private function loadModule($module) {
        $modulePath = $this->libPath . '/' . $module. '/'. $module . '.php';
        if (file_exists($modulePath)) {
            return require_once($modulePath);
        } else {
            throw new \Exception(self::NOT_FOUND . $modulePath);
        }
    }
    
    public function load($module) {
        if (is_array($module) && count($module)) {
            foreach ($module as $m) {
                $this->loadModule($m);
            }
        } elseif (is_string($module)) {
            $this->loadModule($module);
        } else {
            throw new \Exception(self::INVALID_MODULE . getType($module));
        }
    }
}

?>