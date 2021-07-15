<?php
namespace Blog\View;

define('PARTIAL_PATH', __DIR__.'/partials/');

abstract class Base implements iView
{
	protected static $PARTIAL_PATH = PARTIAL_PATH;
	
	protected $partialName;

	protected function preRender()
	{
		include_once self::$PARTIAL_PATH.'header.phtml';
		include_once self::$PARTIAL_PATH.'menu.phtml';
	}
	
	protected function postRender()
	{
		include_once self::$PARTIAL_PATH.'footer.phtml';
	}

	public function __get($name)
	{
		if(isset($this->{$name}))
			return $this->{$name};
		
		return ''; 
	}

	public function __set($name, $value)
	{
		$this->{$name} = $value;
	}
	
	public function add($arr)
	{
		foreach($arr as $key => $val)
		{
			$this->{$key} = $val;
		}
	}

	public function getPartialName()
	{
		return $this->partialName;
	}
	
	public function setPartialName($name)
	{
		$this->partialName = $name;
	}
	
	public function getController()
	{
		if(isset($_GET['controller']))
			return $_GET['controller'];
		
		return '';
	}
	
	public function getAction()
	{
		if(isset($_GET['action']))
			return $_GET['action'];
		
		return '';
	}
	
	public function getUrl()
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
		
		return substr("index.php?controller=$controllerName&action=$actionName&".$str, 0, -1);
	}
        
	public function hasError($fieldName)
	{
		return isset($this->error[$fieldName]) && $this->error[$fieldName];
	}

	public function getError($fieldName)
	{
		if(isset($this->error[$fieldName]))
			return $this->error[$fieldName];
		
		return '';
	}

	public function getFormField($fieldName)
	{
		if(isset($this->form[$fieldName]))
			return $this->form[$fieldName];
		
		return '';
	}
	
	public function render()
	{
		$this->preRender();
		include_once self::$PARTIAL_PATH.$this->getPartialName();
		$this->postRender();
	}
	
	public function renderPartial($partialName, $args)
	{
		foreach($args as $key => $val)
		{
			$this->{$key} = $val;
		}
		include_once self::$PARTIAL_PATH.$partialName;
	}
}
