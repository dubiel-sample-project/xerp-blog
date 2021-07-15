<?php
namespace Blog\Controller;

use Blog\Model as Model;

class Author extends Base
{
	public function indexAction()
	{
		$model = new Model\Author;

		$this->view->authors = $model->fetchAll();
		$this->view->render();
	}
	
}
