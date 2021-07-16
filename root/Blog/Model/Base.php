<?php
namespace Blog\Model;

abstract class Base
{
	public static $USER = 'root';
	public static $PASSWORD = 'root';
	public static $HOST = 'mysql';
	public static $DB = 'blog';
	
	abstract protected function getEntity();
	
	protected $tableName;
	protected $pdo;

	public function __construct()
	{	
		$dsn = 'mysql:dbname='.self::$DB.';host='.self::$HOST;
		$this->pdo = new \PDO($dsn, self::$USER, self::$PASSWORD);
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
	
	public function fetchById(array $ids)
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
	
	public function query(string $query, array $params)
	{
		$stmt = $this->pdo->prepare($query);
		$ret = $stmt->execute($params);
		var_dump($ret);
		var_dump($stmt->debugDumpParams());
		return $stmt->fetchAll();	
	} 
	
	public function parse(array $result)
	{
		$entities = [];
		foreach($result as $row)
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
	
	protected function appendQuery(string $query, string $stmt)
	{
		return $query." {$stmt} ";
	}
}
