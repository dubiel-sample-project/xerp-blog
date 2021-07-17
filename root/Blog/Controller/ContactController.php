<?php
namespace Blog\Controller;

use Blog\Model as Model;
use Blog\Form as Form;

final class ContactController extends BaseController 
{
	public function indexAction() 
	{
		$this->view->render();
	}

	public function addAction() 
	{
		$model = new Model\AuthorModel;

		$this -> view -> authors = $model -> fetchAll();
		
		if (isset($_POST['action']) && strtolower($_POST['action']) === 'addentry') 
		{
			$form = new Form\ContactForm;
			$form->validate($_POST);

			if ($form->hasErrors()) 
			{
				$this->view->add(array('error' => $form -> getErrors()));
				$this->view->add(array('form' => $_POST));

			} else {
				//$model = new Model\Entry;
				//$_POST['published_date'] = time();
				//$id = $model -> save($_POST);
				//$this->redirect('Index', 'detail', 'entry', $id);
			}
		}

		$this ->view->render();
	}
}
