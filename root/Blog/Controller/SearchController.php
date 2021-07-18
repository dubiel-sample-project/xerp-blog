<?php
namespace Blog\Controller;

use Blog\Model as Model;

final class SearchController extends BaseController
{
	public function indexAction()
	{
		$model = new Model\EntryModel;
		$term = $_GET['q'];
		
		$this->view->entries = [];
		if(!empty($term))
		{
			$this->view->entries = $model->fetchBySearch($term);	
		}
	
		$this->view->render();
	}

	public function searchAction()
	{	
		$this->redirect('search', 'index', $_GET['term']);
	}
}
