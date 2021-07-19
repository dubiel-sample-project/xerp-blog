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
			$formFields = [];
			$formFields['url'] = '/blog/add/'.$entryId;
			$formFields['title'] = '';
			$formFields['text'] = '';
			$formFields['action'] = 'addentry';
			$this -> view -> add(['form' => $formFields]);
			
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
					$this->redirect('index', 'detail', $id);
				}
			}
		}

		$this -> view -> render();
	}

	public function deleteAction() 
	{
		$model = new Model\EntryModel;

		$id = $_GET['id'];
		$model -> delete($id);
		
		if(Session::getInstance()->isLoggedIn())
		{
			$this->redirect('index', 'author', Session::getInstance()->get('author_id'));
		} else {
			$this->redirect('index', 'index');
		}
	}

	public function editAction() 
	{
		$this -> view -> title = 'Edit';
		if (Session::getInstance() -> isLoggedIn() ) 
		{
			$model = new Model\EntryModel;

			$entryId = $_GET['id'];
			$entry = $model -> fetchById($entryId);

			$formFields = [];
			$formFields['url'] = '/blog/edit/'.$entryId;
			$formFields['title'] = $entry -> title;
			$formFields['text'] = $entry -> text;
			$formFields['action'] = 'editentry';
			$this -> view -> add(['form' => $formFields]);

			if (isset($_POST['action']) && strtolower($_POST['action']) === 'editentry') 
			{
				$form = new Form\BlogForm;
				$form -> validate($_POST);

				if ($form -> hasErrors()) {
					$this -> view -> add(['error' => $form -> getErrors()]);
					$this -> view -> add(['form' => $_POST]);
				} else {
					$model = new Model\EntryModel;
					$_POST['published_date'] = time();
					$id = $model -> edit($_POST, $entryId);
					$this->redirect('index', 'detail', $entry->title);
				}
			}
		}
		$this -> view -> render();
	}

}
