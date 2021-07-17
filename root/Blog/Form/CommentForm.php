<?php
namespace Blog\Form;

final class CommentForm extends BaseForm
{
	public function __construct()
	{
		$this->addValidator('name', new Validator\Required);
		$this->addValidator('title', new Validator\Required);
		$this->addValidator('content', new Validator\Required);
	}	

}
