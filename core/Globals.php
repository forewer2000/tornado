<?php
namespace core;

class Globals {
	
	public static function post() {
		return $_POST;
	}
	
	public static function get() {
		return $_GET;
	}
	
	public static function getServerData($key) {
	    if (array_key_exists($key, $_SERVER)) {
	        return $_SERVER[$key];
	    }
		throw new \Exception('No souch a server key:'.$key);
	}
	
	public static function files() {
		return $_FILES;
	}

}


?>