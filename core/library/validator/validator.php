<?php
namespace core\library\validator;

class Validator {
    
    const VALIDATOR_DELIMITER = "|";
    const VALIDATOR_PARAM_DELIMITER = ":";
    const VALIDATOR_METHOD_PREFIX = "_";

    
    /**
     * $filter string - filter names delimited by | as default. Each filter
     * is called if the method with that name exists.
     */
    public static function run($validator, $data) {
        if (!is_string($validator)) {
            return array();
        }
        $validator = trim($validator);
        if (!$validator) {
            return array();
        }
        
        $validator_parts = explode(self::VALIDATOR_DELIMITER, $validator);
        if (!$validator_parts) {
            return array();
        }
        $errors = array();
        foreach ($validator_parts as $vp) {
            $vp_parts = explode(self::VALIDATOR_PARAM_DELIMITER, $vp);
            $vMethod = array_shift($vp_parts);
            
            $vMethod = self::VALIDATOR_METHOD_PREFIX . $vMethod;
 
            if (method_exists(__CLASS__, $vMethod)) {
                try {
                    call_user_func(array(__CLASS__, $vMethod), $data, $vp_parts);
                } catch (\Exception $e) {
                    $errors[] = $e;
                }
            }
        }
        return $errors;
    } 
    
    private static function rmFirst($str) {
        return substr($str, 1);
    }
    
    public static function _string($data) {
        if (!is_string($data)) {
            throw new \Exception(self::rmFirst(__FUNCTION__));
        }
    }
    
    public static function _number($data) {
        if (!is_numeric($data)) {
            throw new \Exception(self::rmFirst(__FUNCTION__));
        }
    }
    
    public static function _min($data, $args) {
        self::_number($data);
        $minim = (float)$args[0];
        if ($data < $minim) {
            throw new \Exception(self::rmFirst(__FUNCTION__));
        }
    }
    
    public static function _max($data, $args) {
        self::_number($data);
        $maxim = (float)$args[0];
        if ($data > $maxim) {
            throw new \Exception(self::rmFirst(__FUNCTION__));
        }
    }
}

?>