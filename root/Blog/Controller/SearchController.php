<?php
namespace Blog\Controller;

use Blog\Model as Model;

final class SearchController extends BaseController
{
	public function indexAction()
	{
		$model = new Model\Entry;
		
		$term = $_GET['term'];
		
		$this->view->entries = [];
		if(!empty($term))
		{
			$this->view->entries = $model->fetchBySearch($term);	
		}
	
		$this->view->render();
	}

}
