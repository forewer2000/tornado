<?php
namespace core\library\client;

use core\library\Core;

class Client extends Core {

#client need a browser that communicates with the server

    protected $browser;

#client has a network property that describes the network state of the client

    private $network;


#client bindid to session for identification and temporary storage
    
    protected $session;
    

    
    public function __construct() {
    }

    public function attachBrowser($browser) {
        $this->browser = $browser;
    }
    
    public function attachSession($session) {
        $this->session = $session;
    }
    
    public function send($content) {
        #to do | headers and all the other stuff
        echo $content;
    }

}

?>