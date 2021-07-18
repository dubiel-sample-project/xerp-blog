<?php
namespace Blog\Form;

final class Contact extends BaseForm
{
	public function __construct()
	{
		$this->addValidator('message', new Validator\RequiredValidator);
		$this->addValidator('email', new Validator\RequiredValidator);
		$this->addValidator('author', new Validator\RequiredValidator);
	}	

}
