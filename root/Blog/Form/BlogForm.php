<?php
namespace Blog\Form;

final class BlogForm extends BaseForm
{
	public function __construct()
	{
		$this->addValidator('title', new Validator\Required);
		$this->addValidator('content', new Validator\Required);
	}	

}
