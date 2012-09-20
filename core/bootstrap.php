<?php 

define('ROOT_PATH'  , './../../../');
define('CORE_PATH'  , './../../../core/');
define('VENDOR_PATH', '../../../vendor/');
define('CORE_CONFIG', CORE_PATH . 'config/core.yml');

set_include_path(
    implode(PATH_SEPARATOR,
    array(
        get_include_path(),
        CORE_PATH, 
        VENDOR_PATH,
        ROOT_PATH
    ))
);

spl_autoload_extensions(".php");
spl_autoload_register();

core\Core::init(CORE_CONFIG);
core\Core::run();