<?php
    define('CORE_PATH'  , './../../../core/');
    define('VENDOR_PATH', '../../../vendor/');
    define('CORE_CONFIG', CORE_PATH . 'config/core.yml');

    set_include_path(get_include_path() . ":" . CORE_PATH . ":" . VENDOR_PATH . ":");

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require_once "core.php";
    use core\Core;
    Core::init(CORE_CONFIG);
    Core::run();
    var_dump(Core::$client->browserRequestAnyData(array('a','b')));
    echo Core::$client->sessionSid();
    //require_once "../../../core/boot.php";
?>