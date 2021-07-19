<?php
namespace Blog\Controller;

use Blog\Model as Model;

final class SearchController extends BaseController
{
	public function indexAction()
	{
		$model = new Model\EntryModel;
		$term = $_GET['q'];
		
		$formFields = [];
		$formFields['term'] = $term;
		$this -> view -> add(['form' => $formFields]);
		
		$this->view->entries = [];
		$this->view->term = '';
		if(!empty($term))
		{
			$this->view->term = $term;
			$this->view->entries = $model->fetchBySearch($term);	
		}
	
		$this->view->render();
	}

	public function searchAction()
	{	
		$this->redirect('search', 'index', $_GET['term']);
	}
}
