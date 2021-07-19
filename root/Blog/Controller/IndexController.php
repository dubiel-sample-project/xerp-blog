<?php
namespace Blog\Controller;

use Blog\Model as Model;
use Blog\Form as Form;
use Blog\Session as Session;

final class IndexController extends BaseController
{
	public function indexAction()
	{
		$model = new Model\EntryModel;

		$this->view->entries = $model->fetchAll();
		$this->view->render();
	}
	
	public function detailAction()
	{
		$entryId = '';
		$entry = null;
		$this->view->entries = [];
		$this->view->comments = [];

		$entryModel = new Model\EntryModel;

		if(isset($_GET['id']))
		{
			$entryId = $_GET['id'];
			$entry = $entryModel->fetchById($entryId);
		}
		else if(isset($_GET['q']))
		{
			$entries = $entryModel->fetchByTitle($_GET['q']);			
			if(count($entries) > 0)
			{
				$entry = current($entries);
			}
		}
		else
		{
			$this->redirect('index', 'index');
		}
		
		$commentModel = new Model\CommentModel;
		
		$entryId = $entry->id;
		$this->view->entry = $entry;
		$this->view->entries = [$entry];
		$this->view->comments = $commentModel->fetchByEntry([$entryId]);
				
		if(isset($_POST['action']) && strtolower($_POST['action']) === 'addcomment') 
		{
			$form = new Form\CommentForm;
			$form->validate($_POST);

			if($form->hasErrors())
			{
				$this->view->add(['error' => $form->getErrors()]);
				$this->view->add(['form' => $_POST]);
			} else {
				$commentModel->save($_POST);
				$this->redirect('index', 'detail', $entry->title);
			}
		}    
		
		$this->view->render();
	}
	
	public function authorAction()
	{
		$entryModel = new Model\EntryModel;
		
		$this->view->entries = [];
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$this->view->entries = $entryModel->fetchByAuthor([$id]);
		}
		else if(isset($_GET['q']))
		{
			$authorModel = new Model\AuthorModel;
			$author = $authorModel->fetchByFullname($_GET['q']);
			if($author)
			{
				$this->view->entries = $entryModel->fetchByAuthor([$author->id]);
			}		
		}
		else
		{
			$this->redirect('index', 'index');
		}
		
		$this->view->render();
	}
	
	public function loginAction()
	{
		$model = new Model\AuthorModel;
		
		if(isset($_POST['email']))
		{
			$author = $model->fetchByEmail($_POST['email']);
			if($author)
			{
				if(!password_verify($_POST['password'], $author->password))
				{
					$this->redirect('index', 'login');
				}
				
				Session::getInstance()->set('author_id', $author->id);
				$this->redirect('index', 'author', $author->fullname);
			}			
		}
		
		$this->view->setPartialName('login.phtml');
		$this->view->render();
	}
	
	public function logoutAction()
	{
		Session::getInstance()->destroy();
		$this->redirect('Index', 'index');
	}
}
