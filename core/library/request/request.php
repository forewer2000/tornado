<?php

namespace core\library\request;

require_once __DIR__ . "/../core.php";
require_once __DIR__ ."/requestAtom.php";

use core\library\Core;

class Request extends Core{
    
    const REQUEST_URI = 'REQUEST_URI';
    
    const PATH_INFO = 'PATH_INFO';
    
    const QUERY_STRING = 'QUERY_STRING';
    
    private $pathParts; 
    
    private $query_parts;
    
    private $server;
    
    protected $get;
    
    protected $post;
    
    private $files;
    
    public function __construct($server, $post_data,  $files) {
        $this->server   = $server;
        $this->files    = $files;
        $this->post_data = $post_data;
    }
    
    
    private function loadGetData() {
        $this->get = new requestAtom($this->query_parts);
    }
    
    private function loadPostData() {
        $this->post = new requestAtom($this->post_data);
    }
    
    private function loadAnyData() {
        $mixed = array_merge(
            $this->query_parts, 
            $this->post_data
        );
        $this->any = new requestAtom($mixed);
    }
    
    public function load() {
        $this->loadQueryParams();
        $this->loadPathParams();
        $this->loadGetData();
        $this->loadPostData();
        $this->loadAnyData();
    }
    
    public function all() {
        $ret = new \StdClass();
        $ret->pathParts = $this->pathParts;
        $ret->query_parts = $this->query_parts;
        $ret->get = $this->get;
        $ret->post = $this->post;
        $ret->files = $this->files;
        return $ret;
    }
    
    private function loadQueryParams() {
        if ($this->query_parts !== NULL) {
            return;
        }
        $this->query_parts = array();
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
            $this->query_parts[$qpItem[0]] = $qpItem[1];
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