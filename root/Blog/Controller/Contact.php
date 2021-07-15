<?php
namespace Blog\Controller;

use Blog\Model as Model;
use Blog\Form as Form;

class Contact extends Base {
	
	public function indexAction() {
		$this->view->render();
	}

	public function addAction() {

		$model = new Model\Author;

		$this -> view -> authors = $model -> fetchAll();
		//$this -> view -> render();

		if (isset($_POST['action']) && strtolower($_POST['action']) === 'addentry') {
			$form = new Form\Contact;
			$form->validate($_POST);

			if ($form->hasErrors()) {
		
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
