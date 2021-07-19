<?php
namespace Blog\View;

define('PARTIAL_PATH', __DIR__.'/partials/');

abstract class BaseView
{
	protected static string $PARTIAL_PATH = PARTIAL_PATH;
	
	protected string $partialName;

	protected function preRender()
	{
		include_once self::$PARTIAL_PATH.'header.phtml';
		include_once self::$PARTIAL_PATH.'menu.phtml';
		include_once self::$PARTIAL_PATH.'pageheader.phtml';
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
	
	public function add(array $arr)
	{
		foreach($arr as $key => $val)
		{
			$this->{$key} = $val;
		}
	}

	public function getPartialName() : string
	{
		return $this->partialName;
	}
	
	public function setPartialName(string $name)
	{
		$this->partialName = $name;
	}
	
	public function getController() : string
	{
		if(isset($_GET['controller']))
			return $_GET['controller'];
		
		return '';
	}
	
	public function getAction() : string
	{
		if(isset($_GET['action']))
			return $_GET['action'];
		
		return '';
	}
	
	public function getUrl(string $controller, string $action, ?string $q = '') : string
	{
		return "/{$controller}/{$action}/".$q;
	}
        
	public function hasError(string $fieldName) : bool
	{
		return isset($this->error[$fieldName]) && $this->error[$fieldName];
	}

	public function getError(string $fieldName) : string
	{
		if(isset($this->error[$fieldName]))
			return $this->error[$fieldName];
		
		return '';
	}

	public function getFormField(string $fieldName) : string
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
	
	public function renderPartial(string $partialName, array $args)
	{
		foreach($args as $key => $val)
		{
			$this->{$key} = $val;
		}
		include_once self::$PARTIAL_PATH.$partialName;
	}
}
