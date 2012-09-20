<?php

namespace core;

abstract class Base {
    
    private $provider;
    
    public function __construct($provider) {
        $this->provider = $provider;
    }

}

?>