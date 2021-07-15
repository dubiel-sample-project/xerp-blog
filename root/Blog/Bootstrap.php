<?php
namespace Blog;

class Bootstrap
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
	
	public function route()
	{
		$controllerName = 'Index';
		$actionName = 'indexAction';
			
		if(isset($_GET['controller']))
			$controllerName = ucfirst($_GET['controller']); 

		if(isset($_GET['action']))
			$actionName = strtolower($_GET['action']).'Action';
		
		$controllerFQN = __NAMESPACE__.'\Controller\\'.$controllerName;
		
		$controller = new $controllerFQN;
		$controller->$actionName(); 
	}
}
