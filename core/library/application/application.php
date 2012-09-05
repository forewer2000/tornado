<?php

namespace core\library\applications;

class Application {
    
    const $DOCUMENT_ROOT = 'DOCUMENT_ROOT';
    
    const $HTTP_HOST = 'HTTP_HOST';
    
    private $documentRoot;
    
    private $host;
    
    public function __construct($server) {
        $this->server = $server;
    }
    
    public function load() {
        $this->documentRoot = $this->server[self::DOCUMENT_ROOT];
        $this->host = $this->server[self::HTTP_HOST];
    }
    
    public function getDocumentRoot() {
        return $this->documentRoot;
    }
    
    public function getHost(){
        return $this->host;
    }
}

?>