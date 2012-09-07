<?php

namespace core\library\cookie;

class Cookie {
        
    public function __construct($cookie) {
        $this->cookie = (array)$cookie;
    }
    
    public function set($field, $value) {
        
    }
    
    public function get($field) {
        $field = (string)$field;
        if (!array_key_exists($field, $this->cookie)) {
            return null;
        }
        return $this->cookie[$field];
    }

}

class CookieJar {
    
    private $id;
    
    public function __construct($dir) {
        $this->dir = $dir;
    }
    
    public function __toString() {
        if (!$this->id) {
            $this->id = unique_id();
        }
        return $this->dir . '/' . $this->id;
    }
}

?>