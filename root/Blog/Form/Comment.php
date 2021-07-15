<?php
namespace Blog\Form;

class Comment extends Base
{
	public function __construct()
	{
		$this->addValidator('name', new Validator\Required);
		$this->addValidator('title', new Validator\Required);
		$this->addValidator('content', new Validator\Required);
	}	

}
