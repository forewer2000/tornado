<?php

namespace core\library\client;

class C {
    
    public function store($key, $value);
    public function restore($key);
    
    public function find($item); //ip, id, ...
    public function hasPerm($perm); // hasPerm('logged');
    
}

class Global {
    static function post() {
        return $_POST;
    }
}

class Common {
    
    static $container;
    
    private function get($param) {
        if (is_object($this->container) &&
            $container->{$param}) {
                return $container->{$param};
            }
        return null;
    }
    
    public static function store($param, $value) {
        if (!is_object($this->container)) {
            $this->container = new StdClass();
        }
        
        $this->container->{$param} = $value;
    }
}


class Request {
    
    private static $paramBag = array();

    public function length() {
        return count($paramBag);
    }
    
}

class Post extends Request {
    
    private static $paramBag = $_POST;
    
    public static function __callStatic($x) {
        $x = trim($x);
§        if (array_key_exists($x, $this->paramBag)) {
            return $this->paramBag[$x];
        }
        throw new Exception('', 1);
    }

}



class Get extends Request {
    
}



class Client extends Common {

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