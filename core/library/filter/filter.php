<?php
namespace core\library\filter;

class Filter {
    
    const FILTER_DELIMITER = "|";
    const FILTER_METHOD_PREFIX = "_";
 
    
    /**
     * $filter string - filter names delimited by | as default. Each filter
     * is called if the method with that name exists.
     */
    public static function run($filter, $data) {
        if (!is_string($filter)) {
            return $data;
        }
        $filter = trim($filter);
        if (!$filter) {
            return $data;
        }
        
        $filter_parts = explode(self::FILTER_DELIMITER, $filter);
        if (!$filter_parts) {
            return $data;
        }
        foreach ($filter_parts as $f) {
            $f = self::FILTER_METHOD_PREFIX . $f;
            if (method_exists(__CLASS__, $f)) {
                $data = call_user_func(array(__CLASS__, $f), $data);
            }
        }
        return $data;
    } 
    
    public static function _trim($data) {
        return trim($data);
    }
    
    public static function _upper($data) {
        return strtoupper($data);
    }
    
    public static function _lower($data) {
        return strtolower($data);
    }
    
    public static function _ucfirst($data) {
        return ucfirst($data);
    }

}

?>