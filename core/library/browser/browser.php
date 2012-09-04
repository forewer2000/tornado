<?php

namespace core\library\browser;


class Browser {

#browser has a user agent

    private $userAgent;

    
    
    public function setUserAgent(String $ua) {
        $this->userAgent = $ua;
    }
    
    public function getUserAgent() {
        return $this->userAgent;
    }
    
    
    public function getResponse($url) {
        
    }
}

?>

<?php


namespace app\models\ws;


class WebserviceCaller {

    /**
    * @param $xml (string) xml string returned by ws
    * @return $result (SimpleXmlElement) .
    */
    public function xmlToObject($xml){
        $result = @simplexml_load_string($xml);
        return $result;
    }

    /**
    * @param $params (string) ws url
    * @param $params (string) parameters to send to ws url encoded
    * @return $xmlResult (string) xml returned by ws
    */
    public function curlCall($url, $params){
        $cookieFile = "/tmp/CURLCOOKIE".md5(session_id());

        try{
            $curlHandler = curl_init();
            curl_setopt($curlHandler, CURLOPT_URL, $url);
            curl_setopt($curlHandler, CURLOPT_COOKIEJAR, $cookieFile);
            curl_setopt($curlHandler, CURLOPT_COOKIEFILE, $cookieFile);
            curl_setopt($curlHandler, CURLOPT_POST, count($params));
            curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $params);
            curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($curlHandler, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:12.0) Gecko/20100101 Firefox/12.0');
            // curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $header);
            $result = curl_exec($curlHandler);

            if(empty($result)){
                $error = "curlCall method throw an exception trying to call: \n".$url."\n with parameters \n".$params;
                return new \Exception($error, -1);
            }

            if($result == 'error'){
                $error = $url.' returned an unknown error.';
                return new \Exception($error, -2);
            }

            return $result;
        }catch(Exception $e){
            $error = "curlCall method throw an exception trying to call: \n".$url."\n with parameters \n".$params;
            return new \Exception($error, -3);
        }
    }
}
?>