<?php
namespace Blog\Model;
use Blog\Model\Entities\BaseEntity;

abstract class BaseModel
{
	public static string $USER = 'root';
	public static string $PASSWORD = 'root';
	public static string $HOST = 'mysql';
	public static string $DB = 'blog';
	
	abstract protected function getEntity() : BaseEntity;
	
	protected string $tableName;
	protected \PDO $pdo;

	public function __construct()
	{	
		$dsn = 'mysql:dbname='.self::$DB.';host='.self::$HOST;
		$this->pdo = new \PDO($dsn, self::$USER, self::$PASSWORD);
	} 
	
	public function getTableName() : string
	{
		return $this->tableName;
	}
	
	public function fetchAll(): array
	{
		$query = sprintf("SELECT %s FROM %s %s %s", '*', $this->tableName, 'WHERE 1=1', 'LIMIT 0,');
		$result = mysqli_query($query, $this->_link);
		if(is_resource($result))
		{
			return $result;
		}        
		
		return '';	
	}
	
	public function fetchById(array $ids): array
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
	
	public function query(string $query, array $params): array
	{
		$stmt = $this->pdo->prepare($query);
		$ret = $stmt->execute($params);
		return $stmt->fetchAll();	
	} 
	
	public function parse(array $result): array
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

	public function save(array $arr)
	{
		$query = $this->getSaveQuery($arr);
		$this->query($query);
	}
        
	public function edit(array $arr, string $id)
	{
		$query = $this->getEditQuery($arr, $id);
		$this->query($query);
	}
        
	public function delete(string $id)
	{
		$query = $this->getDeleteQuery($id);
		$this->query($query);
	}        
	
	protected function getSaveQuery(array $arr) : string
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
        
	protected function getEditQuery(array $arr, string $id) : string
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

	protected function getDeleteQuery(string $id) : string
	{
		return sprintf("DELETE FROM %s WHERE id = %s", $this->tableName, $id);
	}
	
	protected function appendQuery(string $query, string $stmt) : string
	{
		return $query." {$stmt} ";
	}
}
