<?php

namespace core\library\client;

require_once __DIR__ . "/../core.php";
use core\library\Core;

class Client extends Core {

#client need a browser that communicates with the server

    protected $browser;

#client has a network property that describes the network state of the client

    private $network;

    
#client bindid to session for identification and temporary storage
    
    protected $session;
    
    private $id;
    
    
    public function __construct($config) {
        $this->config = $config;
    }

    public function attachBrowser($browser) {
        $this->browser = $browser;
    }
    
    public function attachSession($session) {
        $this->session = $session;
    }

    public function attachRequest($request) {
        $this->request = $request;
    }
    
#client has an identification number. Currently this is the session ID

    public function id() {
        return $this->id;
    }
    
#the client could send a package of parameters. Here we can access from the outside    

    public function package() {
        return $this->request->all();
    }

}

?>