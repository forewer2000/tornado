<?php 

define('ROOT_PATH'  , './../../../');
define('CORE_PATH'  , ROOT_PATH . 'core/');
define('VENDOR_PATH', ROOT_PATH . 'vendor/');
define('CORE_CONFIG', CORE_PATH . 'config/core.yml');
define('TAL_PATH', VENDOR_PATH . 'phptal/PHPTAL-1.2.2/');
set_include_path(
    implode(PATH_SEPARATOR,
    array(
        get_include_path(),
        VENDOR_PATH,
        ROOT_PATH,
        TAL_PATH
    ))
);


spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class).'.php';
    require_once $file; 
});

core\Core::init(CORE_CONFIG);
core\Core::run();