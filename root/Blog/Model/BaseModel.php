<?php
namespace Blog\Model;
use Blog\Model\Entities\BaseEntity;

abstract class BaseModel
{
	private static string $USER = 'root';
	private static string $PASSWORD = 'root';
	private static string $HOST = 'mysql';
	private static string $DB = 'blog';
	
	abstract protected function getEntity() : BaseEntity;
	abstract protected function getSelectQuery() : string;
	abstract protected function getTableName() : string;

	protected \PDO $pdo;

	public function __construct()
	{	
		$dsn = 'mysql:dbname='.self::$DB.';host='.self::$HOST;
		$this->pdo = new \PDO($dsn, self::$USER, self::$PASSWORD);
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

	public function save(array $arr) : int
	{
		$dataMap = $this->getEntity()->getDataMap();
		$columns = [];
		$values = [];
		foreach($arr as $key => $val)
		{
			if(!isset($dataMap[$key]))
				continue;
			
			$columns[] = $key;
			$values[] = (is_numeric($val)) ? $val : $this->pdo->quote($val);
		}
		
		$columns = implode(',', $columns);
		$values = implode(',', $values);
		
		$stmt = $this->pdo->query("INSERT INTO `".$this->getTableName()."` ({$columns}) VALUES ({$values})");
		$stmt->closeCursor();
		
		return $this->pdo->lastInsertId();
	}
        
	public function edit(array $arr, string $id)
	{
		$dataMap = $this->getEntity()->getDataMap();
		$str = '';
		foreach($arr as $key => $val)
		{
			if(!isset($dataMap[$key]))
				continue;

			$str .= (is_numeric($val)) ? "$key = $val," : "$key = '$val',";
		}
		$str = substr($str, 0, -1);
		
		$this->pdo->query("UPDATE `".$this->getTableName()."` SET {$str} WHERE id = {$id}");
	}
        
	public function delete(string $id) : bool
	{
		$stmt = $this->pdo->prepare($this->getDeleteQuery($id));
		return $stmt->execute($params);
	}        
	
	protected function getDeleteQuery(string $id) : string
	{
		return sprintf("DELETE FROM %s WHERE id = %s", $this->getTableName(), $id);
	}
	
	protected function appendQuery(string $query, string $stmt) : string
	{
		return $query." {$stmt} ";
	}
}
