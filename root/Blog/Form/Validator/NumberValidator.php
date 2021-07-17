<?php
namespace Blog\Form\Validator;

class NumberValidator extends BaseValidator
{
	public function validate(string $val)
	{
		$pattern = '/^\d+$/';
		if(!preg_match($pattern, $val))
		{
			$this->hasError = true;
			return true;
		}	
                
		return false;
	}
}
