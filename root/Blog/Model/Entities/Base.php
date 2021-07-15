<?php
namespace Blog\Model\Entities;

abstract class Base
{
	protected $dataMap = [];
	protected $data = [];
	
	public function __get($name)
	{
		if(isset($this->data[strtolower($name)]))
			return $this->data[strtolower($name)];
		
		return ''; 
	}

	public function __set($name, $value)
	{
		$this->data[strtolower($name)] = $value;
	}
        
	public function getDataMap()
	{
		return $this->dataMap;
	}

	public function map($row)
	{
		$keys = array_keys($row);
		foreach($keys as $val)
		{
			if(isset($this->dataMap[$val]))
			{
				$this->{$val} = $row[$val];
			}	
		}
	}
}