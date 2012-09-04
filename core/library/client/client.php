<?php

namespace core\library\client;


class Client {

#client need a browser that communicates with the server

    private $browser;

#client has a network property that describes the network state of the client

    private $network;

#client has a request property that represents the requests from client side

    private $request;
    
    public function __construct($browser, $network, $request) {
        $this->browser = $browser;
    }

}

?>