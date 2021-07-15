<?php
namespace Blog\Form\Validator;

abstract class Base
{
	protected $hasError = false;
	protected $msg = '';
    
	abstract public function validate($val);
        
	public function getMessage()
	{
		return $this->msg;
	}
}
