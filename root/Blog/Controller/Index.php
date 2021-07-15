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
		$model = new Model\Entry;
		$commentModel = new Model\Comment;
		
		$id = $_GET['entry'];
		$this->view->entryId = $id;
		
		$this->view->comments = $commentModel->fetchByEntry(array($id));
		$this->view->entries = $model->fetchById(array($id));
		
		if(isset($_POST['action']) && strtolower($_POST['action']) == 'addcomment') 
                {
                    $form = new Form\Comment;
                    $form->validate($_POST);

                    if($form->hasErrors())
                    {
                        $this->view->add(array('error' => $form->getErrors()));
                        $this->view->add(array('form' => $_POST));
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
		$this->view->entries = $model->fetchByAuthor(array($id));
		$this->view->render();
	}
	
	public function loginAction()
	{
		$model = new Model\Author;
		
		$name = $_POST['name'];
		$pass = $_POST['pass'];
		
		if(!empty($name) && !empty($pass)){

		  if($authorId = $model->fetchByLogin($name, $pass)){
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
