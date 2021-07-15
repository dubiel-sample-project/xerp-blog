<?php
namespace Blog\Form\Validator;

class Required extends Base
{
	public function __construct() 
	{
		$this->msg = 'Field is required.';
	}
    
	public function validate($val)
	{
		if(strlen($val) === 0)
		{
			$this->hasError = true;
			return true;
		}
                
		return false;
	}
}
