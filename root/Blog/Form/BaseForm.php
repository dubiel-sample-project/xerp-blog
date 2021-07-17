<?php
namespace Blog\Form;

abstract class BaseForm
{
	protected array $validators = [];
	protected array $errors = [];
        
	public function getErrors() : array
	{
		return $this->errors;
	}
	
	public function hasErrors() : bool
	{
		return count($this->errors) > 0;
	}
        
	public function addValidator($fieldName, $validator)
	{
		$this->validators[$fieldName] = $validator;
	}
	
	public function validate($arr)
	{
		$this->errors = [];
		foreach($arr as $key => $val)
		{
			if(isset($this->validators[$key]))
			{
				if($this->validators[$key]->validate($val))
				{
					$this->errors[$key] = $this->validators[$key]->getMessage();
				}
			}
		}
	}
}
