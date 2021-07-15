<?php
namespace Blog\Model;

abstract class Base
{
	public static $USER = 'blog';
	public static $PASSWORD = 'blog';
	public static $HOST = '127.0.0.1';
	public static $DB = 'blog';
	
	abstract protected function getEntity();
	
	protected $tableName;
	protected $_link;

	public function __construct()
	{
		//$this->_link = mysqli_connect(self::$HOST, self::$USER, self::$PASSWORD);
		
		$dsn = 'mysql:dbname='.self::$DB.';host='.self::$HOST;
		$this->_link = new \PDO($dsn, self::$USER, self::$PASSWORD);
		//mysqli_select_db(self::$DB, $this->_link);
	} 
	
	public function getTableName()
	{
		return $this->tableName;
	}
	
	public function fetchAll()
	{
		$query = sprintf("SELECT %s FROM %s %s %s", '*', $this->tableName, 'WHERE 1=1', 'LIMIT 0,');
		$result = mysqli_query($query, $this->_link);
		if(is_resource($result))
		{
			return $result;
		}        
		
		return '';	
	}
	
	public function fetchById($ids)
	{
		$ids = implode(',', $ids);
		$query = sprintf("SELECT %s FROM %s %s %s", '*', $this->tableName, "WHERE id IN = ($ids)", 'LIMIT 0,');
		$result = mysqli_query($query, $this->_link);
		if(is_resource($result))
		{    
			return $result;
		}        
		
		return '';	
	}
	
	public function query($query)
	{
		$result = mysqli_query($query, $this->_link);
		if(is_resource($result))
		{
			return $result;
		}        
		
		return '';	
	} 
	
	public function parse($result)
	{
		$entities = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$entity = $this->getEntity();
			$entity->map($row);
			$entities[] = $entity;
		}
		return $entities;
	}

	public function save($arr)
	{
		$query = $this->getSaveQuery($arr);
		var_dump($query);
		$this->query($query);
	}
        
	public function edit($arr, $id)
	{
		$query = $this->getEditQuery($arr, $id);
		var_dump($query);
		$this->query($query);
	}
        
	public function delete($id)
	{
		$query = $this->getDeleteQuery($id);
		var_dump($query);
		$this->query($query);
	}        
	
	protected function getSaveQuery($arr)
	{
		$dataMap = $this->getEntity()->getDataMap();
		$columns = [];
		$values = [];
		foreach($arr as $key => $val)
		{
			if(!isset($dataMap[$key]))
				continue;
			
			$key = mysqli_real_escape_string($key);
			$columns[] = $key;

			$val = mysqli_real_escape_string($val);
			$values[] = (is_numeric($val)) ? $val : "'$val'";
		}
		return sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->tableName, implode(',', $columns), implode(',', $values));
	}
        
	protected function getEditQuery($arr, $id)
	{
		$dataMap = $this->getEntity()->getDataMap();
		$str = '';
		foreach($arr as $key => $val)
		{
			if(!isset($dataMap[$key]))
				continue;

			$key = mysqli_real_escape_string($key);
			$val = mysqli_real_escape_string($val);
			$str .= (is_numeric($val)) ? "$key = $val," : "$key = '$val',";
		}
		$str = substr($str, 0, -1);
		return sprintf("UPDATE %s SET %s WHERE id = %s", $this->tableName, $str, $id);
	}

	protected function getDeleteQuery($id)
	{
		return sprintf("DELETE FROM %s WHERE id = %s", $this->tableName, $id);
	}
}
