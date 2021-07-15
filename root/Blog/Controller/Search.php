<?php
namespace Blog\Controller;
use Blog\Model as Model;

class Search extends Base 
{

	public function indexAction()
	{
		$model = new Model\Entry;
		
		$term = $_GET['term'];
		
		if(!empty($term)){
		  $this->view->entries = $model->fetchBySearch($term);	
		}
	
		$this->view->render();
	}

}
