<?php

namespace core\library\request;


class Request {
    
    const REQUEST_URI = 'REQUEST_URI';
    
    const PATH_INFO = 'PATH_INFO';
    
    const QUERY_STRING = 'QUERY_STRING';
    
    private $pathParts; 
    
    private $queryParts;
    
    private $server;
    
    private $get;
    
    private $post;
    
    private $files;
    
    public function __construct($server, $post, $get, $files) {
        $this->server   = $server;
        $this->post     = $post;
        $this->get      = $get;
        $this->files    = $files;
    }
    
    public function load() {
        $this->loadQueryParams();
        $this->loadPathParams();
    }
    
    public function all() {
        $ret = new \StdClass();
        $ret->pathParts = $this->pathParts;
        $ret->queryParts = $this->queryParts;
        $ret->get = $this->get;
        $ret->post = $this->post;
        $ret->files = $this->files;
        return $ret;
    }
    
    private function loadQueryParams() {
        if ($this->queryParts !== NULL) {
            return;
        }
        $this->queryParts = array();
        if (!array_key_exists(self::QUERY_STRING, $this->server)) {
            return;
        }

        $queryPartPairs = explode('&',  $this->server[self::QUERY_STRING]);
        
        if (!count($queryPartPairs)) {
            return;
        }
        foreach ($queryPartPairs as $qpp) {
            $qpItem = explode('=', $qpp);
            if (count($qpItem) !== 2) {
                continue;
            }
            $this->queryParts[$qpItem[0]] = $qpItem[1];
        }
    }
    
    private function loadPathParams() {
        $this->pathParts = array();
        if (!array_key_exists(self::PATH_INFO, $this->server)) {
            return;
        }
        $pathParts = explode('/',  $this->server[self::PATH_INFO]);
        if (count($pathParts)) {
            foreach ($pathParts as $p) {
                if (trim($p)) {
                    $this->pathParts[] = $p;
                }
            }
        }
    }

}

?>