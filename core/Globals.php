<?php
namespace core;

class Globals {
	
	public static function post() {
		return $_POST;
	}
	
	public static function get() {
		return $_GET;
	}
	
	public static function server() {
		return $_SERVER;
	}
	
	public static function files() {
		return $_FILES;
	}

}


?>