<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    require_once "provider.php";
    require_once "libloader.php";
    $loader = new core\LibLoader(__DIR__ . '/library');
    $modulesToLoad = array(
        'client',
        'session',
        'storage',
        'network',
        'request',
        'browser',
        'headers'
    );
    try {
        $loader->load($modulesToLoad);
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
    
    $session = new core\library\session\Session();
    $request = new core\library\request\Request($_SERVER, $_POST, $_GET, $_FILES);
    $browser = new core\library\browser\Browser($_SERVER);
    $request->load();
    
    $client = new core\library\client\Client();
    $client->attachBrowser($browser);
    $client->attachSession($session);
    $client->attachRequest($request);
/*
    $solutioner = new core\app\Solutioner();
    $solutioner->attachClient($client);
    $solutioner->find();
    
    $view = new core\app\View();
    $view->attachSolution($solutioner->result());
    
    $client->send($view->render());
  */  
?>
