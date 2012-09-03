<?php
  
# ANY INITIALIZATION FOR TESTING GOES IN THIS FILE
   
   
# Add app location to the include path so require-s will remain clean
    
   define('APP_PATH', 'core/app');
   define('LIB_PATH', 'core/library');
   set_include_path(get_include_path() . ":" . APP_PATH . ":" . LIB_PATH . ":");

?>