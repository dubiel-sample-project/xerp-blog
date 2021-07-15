<?php
namespace Blog\Form;

class Contact extends Base
{
	public function __construct()
	{
		$this->addValidator('message', new Validator\Required);
		$this->addValidator('email', new Validator\Required);
		$this->addValidator('author', new Validator\Required);
	}	

}
