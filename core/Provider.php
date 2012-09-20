<?php

namespace core;

abstract class Provider {
    
    static private $loaded_modules;
    
    static private $available_modules = array();
    
    public static function setModules($available_modules) {
        self::$available_modules = $available_modules;
    }
    
    public static function addClass($class_name, $class_instance) {
        $class_name = trim((string)$class_name);
        if (!$class_name) {
            throw new \Exception("Invalid class name:".$class_name);
        }
        
        if (!is_object($class_instance)) {
            throw new \Exception("Must be an instance of a class ");
        }
        
        self::$loaded_modules[$class_name] = $class_instance;
    }
    
    public static function singleton($module, $params = null) {
        
        if (!is_string($module)) {
            throw new \Exception('Invalid module name:'. $module);
        }

        if (array_key_exists($module, self::$loaded_modules)) {
            return self::$loaded_modules[$module];
        }
        
        if (!in_array($module, self::$available_modules)) {
            throw new \Exception('Module not available:'. $module);
        }
        
        if (!@require_once self::$availableModules[$module]) {
            throw new Exception("Failed to include ". self::$availableModules[$module]);  
        }
        
        if (!class_exists($module)) {
            throw new \Exception("Class doesn't exists:".$module);
        }
        
        $this->loaded_modules[$module] =  new ${module}($params);
    }
}

?>