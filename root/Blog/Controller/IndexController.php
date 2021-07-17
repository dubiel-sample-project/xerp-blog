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
		$entryModel = new Model\EntryModel;
		$commentModel = new Model\CommentModel;
		
		$id = $_GET['id'];
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
				$this->redirect('Index', 'detail', 'id', $id);
			}
		}    
		
		$this->view->render();
	}
	
	public function authorAction()
	{
		$model = new Model\EntryModel;
		
		$id = $_GET['id'];
		$this->view->entries = $model->fetchByAuthor([$id]);
		$this->view->render();
	}
	
	public function loginAction()
	{
		$model = new Model\AuthorModel;
		
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
