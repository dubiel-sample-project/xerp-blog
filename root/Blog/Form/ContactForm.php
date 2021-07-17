<?php
namespace Blog\Form;

final class Contact extends BaseForm
{
	public function __construct()
	{
		$this->addValidator('message', new Validator\Required);
		$this->addValidator('email', new Validator\Required);
		$this->addValidator('author', new Validator\Required);
	}	

}
