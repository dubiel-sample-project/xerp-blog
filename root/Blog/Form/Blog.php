<?php
namespace Blog\Form;

class Blog extends Base
{
	public function __construct()
	{
		$this->addValidator('title', new Validator\Required);
		$this->addValidator('content', new Validator\Required);
	}	

}
