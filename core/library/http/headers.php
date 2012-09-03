<?php

namespace core\library\http;


class Headers {
    
    private $headers;
        
    public function __construct(\core\library\data\Util $dataUtil) {
        $this->headers = array();
        $this->dataUtil = $dataUtil;
    }
    
    public function setField($fieldName, $fieldValue) {
        
        $fieldName  = $this->dataUtil->strClean($fieldName);
        $fieldValue = $this->dataUtil->strClean($fieldValue);

        if (!$fieldName) {
            return false;
        }
        $this->headers[$fieldName] = $fieldValue;
        return true;
    }
    
    public function getField($fieldName) {
        $fieldName = $this->dataUtil->strClean($fieldName);
        if (array_key_exists($fieldName, $this->headers)) {
            return $this->headers[$fieldName];
        }
        return null;
        
    }
    
    /**
     * @return array - all the header field/value pairs in an array.
     *          CURL compatible format
     */
    public function getFullHeader() {
        $tmp = array();
        foreach ($this->headers as $field => $value) {
            $tmp[] = "${field}: ${value}";
        };
        return $tmp;
    }
    
    public function send() {   
        foreach ($this->getFullHeader() as $head) {
            header($head);
        }
    }

}

?>