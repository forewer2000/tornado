<?php

namespace core\library\browser;

/**
 * This Browser class is the public part for a Browser management
 */
class Browser extends AbstractBrowser {

# These methods are for initialize a browser page request
    
    public function setUA($ua) {
        parent::setUA($ua);
    }
    
    public function attachCookie($cookie) {
        parent::attachCookie($cookie);
    }
    
    public function attachPostData($postData) {
        parent::attachPostData($postData);
    }
    
    public function attachFiles($files) {
        parent::attachFiles($files);
    }
    
    public function setHeaders($headers) {
        parent::setHeaders($headers);
    }
    

# The load method try to access the url with all the parameters set below

    public function load($url) {
        parent::load($url);
    }
    

#Getter methods will retreive any data returned after fetching the url

    public function getHeaders() {
        return parent::getHeaders();
    }
    
    public function getResponse() {
        return parent::getResponse();
    }
}





abstract class AbstractBrowser {

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
    
    public function getUserAgent() {
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