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

	public function contactAction() 
	{
		$model = new Model\AuthorModel;

		$this -> view -> authors = $model -> fetchAll();
		
		if (isset($_POST['action']) && strtolower($_POST['action']) === 'contactentry') 
		{
			$form = new Form\ContactForm;
			$form->validate($_POST);

			if ($form->hasErrors()) 
			{
				$this->view->add(array('error' => $form -> getErrors()));
				$this->view->add(array('form' => $_POST));

			} else {
			}
		}

		$this ->view->render();
	}
}
