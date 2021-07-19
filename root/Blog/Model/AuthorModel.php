<?php
namespace Blog\Model;
use Blog\Model\Entity\BaseEntity;

final class AuthorModel extends BaseModel implements iModel
{
	protected function getEntity() : BaseEntity
	{
		return new Entity\AuthorEntity();		
	}
	
	protected function getSelectQuery() : string
	{
		return "SELECT id, firstname, lastname, fullname, email, url, password FROM author";
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

	public function fetchById(string $id) : BaseEntity
	{
		$query = $this->appendQuery($this->getSelectQuery(), "WHERE id = :id");
		return current($this->parse($this->query($query, [':id' => $id])));	
	}
	
	public function fetchByFullname(string $fullname) : BaseEntity
	{
		$query = $this->appendQuery($this->getSelectQuery(), "WHERE fullname = :fullname");
		return current($this->parse($this->query($query, [':fullname' => $fullname])));	
	}
	
	public function fetchByEmail(string $email) : BaseEntity
	{
		$query = $this->appendQuery($this->getSelectQuery(), "WHERE email=:email");
		return current($this->parse($this->query($query, [':email' => $email])));
	}

}
