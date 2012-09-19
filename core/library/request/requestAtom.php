<?php
namespace core\library\request;

use core\library\Core;

class requestAtom extends Core {
    public function __construct($data) {
        if (!is_array($data)) {
            throw new \Exception();
        }
        $this->data = $data;
    }

    protected function one($x) {
        if (array_key_exists($x, $this->data)) {
            return $this->data[$x];
        }
        throw new \Exception();        
    }
    
    protected function data($x) {
        if (is_string($x)) {
            return $this->one($x);
        } elseif (is_array($x)) {
            $ret = array();
            foreach ($x as $key) {
                $ret[$key] = $this->one($key);
            }
            return $ret;
        }
        throw new \Exception();
    }
    
     
    protected function datas() {
        return $this->data;
    }

}

?>