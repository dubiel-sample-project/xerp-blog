<?php
namespace Blog\Model;
use Blog\Model\Entities\BaseEntity;

final class AuthorModel extends BaseModel implements iModel
{
	protected function getEntity() : BaseEntity
	{
		return new Entities\AuthorEntity();		
	}
	
	protected function getSelectQuery() : string
	{
		return "SELECT id, concat(firstname, ' ', lastname) as fullname, email, url FROM author";
	}
	
	protected function getTableName() : string
	{
		return 'author';
	}
	
	public function fetchAll() : array
	{
		$query = $this->appendQuery($this->getSelectQuery(), 'WHERE 1=1');
		$query = $this->appendQuery($query, 'ORDER BY lastname');
		return $this->parse($this->query($query, []));	
	}

	public function fetchById(array $ids) : array
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->getSelectQuery(), "WHERE e.id IN ($ids)");
		$query = $this->appendQuery($query, 'ORDER BY lastname');
		return $this->parse($this->query($query, []));	
	}
	
	public function fetchByLogin(string $lastname, string $pass) : array
	{
		$query = "SELECT id FROM author WHERE lastname=:lastname AND pass=:pass";
		return $this->query($query, [':lastname' => $lastname, ':pass' => $pass]);
	}

}
