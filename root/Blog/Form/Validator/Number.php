<?php
namespace Blog\Form\Validator;

class Number extends Base
{
	public function validate($val)
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
