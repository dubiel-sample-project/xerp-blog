<?php
namespace Blog\Controller;
use Blog\View as View;

abstract class BaseController
{
	protected View\iView $view;
	
	public function redirect(string $controller, string $action, ?string $q = '')
	{
		$location = "/{$controller}/{$action}/" .$q;
		header("Location:$location");
		exit(0);
	}
	
	public function __construct()
	{
		$this->initView();
	}
	
	public function initView()
	{
		$className = str_replace('Controller', 'View', get_class($this));
		$viewFQN = 'Blog\View\\'.substr($className, strrpos($className, '\\') + 1);
		$this->view = new $viewFQN;
	}
}
