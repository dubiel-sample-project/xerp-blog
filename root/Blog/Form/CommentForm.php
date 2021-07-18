<?php
namespace Blog\Form;

final class CommentForm extends BaseForm
{
	public function __construct()
	{
		$this->addValidator('name', new Validator\RequiredValidator);
		$this->addValidator('title', new Validator\RequiredValidator);
		$this->addValidator('content', new Validator\RequiredValidator);
	}	

}
