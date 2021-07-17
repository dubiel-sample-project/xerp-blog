<?php
namespace Blog\Form\Validator;

abstract class BaseValidator
{
	protected bool $hasError = false;
	protected string $msg = '';
    
	abstract public function validate(string $val);
        
	public function getMessage() : string
	{
		return $this->msg;
	}
}
