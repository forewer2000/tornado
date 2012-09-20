<?php

namespace core\library\session;


class Session {

    protected $session_id;
    
    
    public function __construct() {
        if (!session_id()) {
            session_start();
        }
        $this->session_id = session_id();
    }
    
    public function sid() {
        return $this->session_id;
    }
}

?>