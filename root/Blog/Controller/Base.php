<?php
namespace Blog\Controller;
use Blog\View as View;

abstract class Base
{
	protected $view;
	
	public function __call($name, $args)
	{
		//$this->redirect('Index', 'index');
	}
	
	public function redirect()
	{
		$args = func_get_args();
		$controllerName = ucfirst($args[0]);
		$actionName = strtolower($args[1]);
		
		$len = count($args);
		$str = '';
		for($i = 2; $i < $len; $i += 2)
		{
			$str .= $args[$i].'='.$args[$i+1].'&';
		}
		
		$location = substr("index.php?controller=$controllerName&action=$actionName&".$str, 0, -1);
		header("Location:$location");
		exit(0);
	}
	
	public function __construct()
	{
		$this->initView();
	}
	
	public function initView()
	{
		$className = get_class($this);
		$viewFQN = 'Blog\View\\'.substr($className, strrpos($className, '\\') + 1);
		$this->view = new $viewFQN;
	}
}
