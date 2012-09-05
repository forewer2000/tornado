<?php

namespace core\library\client;


class Client {

#client need a browser that communicates with the server

    private $browser;

#client has a network property that describes the network state of the client

    private $network;

#client has a request property that represents the requests from client side

    private $request;
    
#client bindid to session for identification and temporary storage
    
    private $session;
    
    private $id;
    
    
    public function __construct() {
    }

    public function attachBrowser($browser) {
        $this->browser = $browser;
    }
    
    public function attachSession($session) {
        $this->session = $session;
        $this->id = $session->sid();
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