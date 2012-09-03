<?php
    
    namespace core\library\data;
    require_once "data/util-i.php";
    
    Class Util implements UtilInterface {
        
        /**
         * @param $x (any) - a value to be cleaned
         * @return (string) - $x is converted to a string and trimmed
         */
        
        public function strClean($x) {
            return trim((string)$x);
        }
    }

?>