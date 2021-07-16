<?php
namespace Blog\Controller;

use Blog\Model as Model;
use Blog\Form as Form;
use Blog\Session as Session;

class Index extends Base
{
	public function indexAction()
	{
		$model = new Model\Entry;

		$this->view->entries = $model->fetchAll();
		$this->view->render();
	}
	
	public function detailAction()
	{
		$entryModel = new Model\Entry;
		$commentModel = new Model\Comment;
		
		$id = $_GET['entry'];
		$this->view->entryId = $id;
		
		$this->view->comments = $commentModel->fetchByEntry([$id]);
		$this->view->entries = $entryModel->fetchById([$id]);
			
		if(isset($_POST['action']) && strtolower($_POST['action']) === 'addcomment') 
		{
			$form = new Form\Comment;
			$form->validate($_POST);

			if($form->hasErrors())
			{
				$this->view->add(['error' => $form->getErrors()]);
				$this->view->add(['form' => $_POST]);
			} else {
				$commentModel->save($_POST);
				$this->redirect('Index', 'detail', 'entry', $id);
			}
		}    
		
		$this->view->render();
	}
	
	public function authorAction()
	{
		$model = new Model\Entry;
		
		$id = $_GET['author'];
		$this->view->entries = $model->fetchByAuthor([$id]);
		$this->view->render();
	}
	
	public function loginAction()
	{
		$model = new Model\Author;
		
		$name = $_POST['name'];
		$pass = $_POST['pass'];
		
		if(!empty($name) && !empty($pass))
		{
			$authorId = $model->fetchByLogin($name, $pass);
			if(!empty($authorId))
			{
				Session::getInstance()->set('author_id', $authorId);
				  $this->redirect('Index', 'index');
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
