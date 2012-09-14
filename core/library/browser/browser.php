<?php

namespace core\library\browser;


require_once __DIR__ . "/../core.php";
use core\library\Core;

class Browser extends Core{

    const USER_AGENT = 'HTTP_USER_AGENT';

#browser has a user agent

    private $userAgent;

    public function __construct($server) {
        $this->server = $server;
        if (array_key_exists(self::USER_AGENT, $server)) {
            $this->setUserAgent($server[self::USER_AGENT]);
        }

        $this->cleanUp();
    }
    
    
    public function attachRequest($request) {
        $this->request = $request;
    }
    
    private function cleanUp() {
        $this->transfer = true;
        $this->curlHandler = curl_init();
    }
    
    public function attachCookie($cookie) {
        $this->cookie = $cookie;
        curl_setopt($this->curlHandler, CURLOPT_COOKIEJAR, $this->cookie->id());
        curl_setopt($this->curlHandler, CURLOPT_COOKIEFILE, $this->cookie->id());
    }
    
    public function setUserAgent($ua) {
        $this->userAgent = $ua;
    }
    
    public function userAgent() {
        return $this->userAgent;
    }
    
    public function attachPostData($postData) {
        curl_setopt($this->curlHandler, CURLOPT_POST, count($postData));
        curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, $postData);
    }
    
    public function getResponse() {
        
    }
    
    public function setTransfer($ts) {
        $this->transfer = (bool)$ts;
    }
    
    public function load($url) {
        curl_setopt($curlHandler, CURLOPT_URL, $url);
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, $this->transfer);
    }
}

?>