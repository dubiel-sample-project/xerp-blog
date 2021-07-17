<?php
namespace Blog\Controller;

use Blog\Model as Model;
use Blog\Form as Form;
use Blog\Session as Session;

final class BlogController extends BaseController 
{
	public function addAction() 
	{
		$this -> view -> title = 'Add';
		if (Session::getInstance() -> isLoggedIn()) 
		{
			if (isset($_POST['action']) && strtolower($_POST['action']) === 'addentry') 
			{
				$form = new Form\BlogForm;
				$form -> validate($_POST);

				if ($form -> hasErrors()) 
				{
					$this -> view -> add(['error' => $form -> getErrors()]);
					$this -> view -> add(['form' => $_POST]);
				} else {
					$model = new Model\EntryModel;
					$_POST['published_date'] = time();
					$id = $model -> save($_POST);
					//$this->redirect('Index', 'detail', 'entry', $id);
				}
			}
		}

		$this -> view -> render();
	}

	public function deleteAction() 
	{
		$model = new Model\EntryModel;

		$id = $_GET['entry'];
		$model -> delete($id);
		$this->redirect('Index', 'index');
	}

	public function editAction() 
	{
		$this -> view -> title = 'Edit';
		if (Session::getInstance() -> isLoggedIn() ) 
		{
			$model = new Model\EntryModel;

			$entryId = $_GET['entry'];
			$entries = $model -> fetchById([$entryId]);

			$formFields = [];

			foreach ($entries as $key => $entry) 
			{
				$formFields['title'] = $entry -> title;
				$formFields['author'] = $entry -> author;
				$formFields['text'] = $entry -> text;
			}
			$this -> view -> add(['form' => $formFields]);

			if (isset($_POST['action']) && strtolower($_POST['action']) === 'addentry') 
			{
				$form = new Form\BlogForm;
				$form -> validate($_POST);

				if ($form -> hasErrors()) {
					$this -> view -> add(['error' => $form -> getErrors()]);
					$this -> view -> add(['form' => $_POST]);
				} else {
					$model = new Model\Entry;
					$_POST['published_date'] = time();
					$id = $model -> edit($_POST,$entryId);
					$this->redirect('Index', 'detail', 'entry', $entryId);
				}
			}
		}
		$this -> view -> render();
	}

}
