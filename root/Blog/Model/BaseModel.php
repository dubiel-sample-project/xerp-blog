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

	public function save(array $arr) : bool
	{
		$dataMap = $this->getEntity()->getDataMap();
		$columns = [];
		$values = [];
		foreach($arr as $key => $val)
		{
			if(!isset($dataMap[$key]))
				continue;
			
			$columns[] = $key;
			$values[] = (is_numeric($val)) ? $val : "'$val'";
		}
		
		$stmt = $this->pdo->prepare("INSERT INTO :tablename (:columns) VALUES (:values)");
		return $stmt->execute([':tablename' => $this->getTableName(), ':columns' => implode(',', $columns), 
			':values' => implode(',', $values)]);
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
		
		$stmt = $this->pdo->prepare("UPDATE :tablename SET :values WHERE id = :id", );
		return $stmt->execute([':tablename' => $this->getTableName(), ':values' => $str, 
			':id' => $id]);
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
