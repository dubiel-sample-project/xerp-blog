<?php
namespace Blog;

final class Session
{
	private static $inst = null;

	public static function getInstance()
	{
		if(!self::$inst)
		{
			self::$inst = new self();
		}
		
		return self::$inst;
	}
	
	private function __construct(){}
	
	public function start()
	{
		session_start();
	}
	
	public function destroy()
	{
		$_SESSION = array();
	    session_destroy();
	}
	
	public function get($key)
	{
		return $_SESSION[$key];
	}
	
	public function set($key, $value)
	{
		$_SESSION[$key]=$value;
	}
	
	public function isLoggedIn()
	{
		return $this->get('author_id') > 0;
	}
}
