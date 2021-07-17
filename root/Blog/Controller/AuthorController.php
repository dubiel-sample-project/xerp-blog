<?php
namespace Blog\Controller;

use Blog\Model as Model;

final class AuthorController extends BaseController
{
	public function indexAction()
	{
		$model = new Model\Author;

		$this->view->authors = $model->fetchAll();
		$this->view->render();
	}
	
}
