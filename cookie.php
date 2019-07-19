<?php
class Cookie
{
	protected static $_instance; 
	
	private function __construct() {
	}
	
	public static function getInstance() { 
		if (self::$_instance === null) {
            self::$_instance = new self;   
        }
        return self::$_instance;
	} 
 
	public static function setCookie($key, $value, $time = 31536000) {
		setcookie($key, $value, time() + $time, '/') ;
	}
	 
	public static function getCookie($key) {
		if ( isset($_COOKIE[$key]) ){
			return $_COOKIE[$key];
		}
		return null;
	}
	 
	public static function updateCookie($key, $value, $time = 31536000) {
		if ( isset($_COOKIE[$key]) ){
			self::deleteCookie($key);
			setcookie($key, $value, time() + $time, '/') ;
		}
	}
	 
	public static function deleteCookie($key)   {
		if ( isset($_COOKIE[$key]) ){
			self::getCookie($key);
			unset($_COOKIE[$key]);
		}
	}
	
	private function __clone() {
    }

    private function __wakeup() {
		
    } 
}























