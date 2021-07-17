<?php
namespace Blog\Model;
use Blog\Model\Entities\BaseEntity;

final class AuthorModel extends BaseModel implements iModel
{
	private string $selectQuery;
	
	protected function getEntity() : BaseEntity
	{
		return new Entities\Author();		
	}
	
	public function __construct()
	{
		parent::__construct();
		$this->tableName = 'author';
		$this->selectQuery = "
				SELECT id, concat(firstname, ' ', lastname) as fullname, email, url FROM author
			"; 
	}
	
	public function fetchAll() : array
	{
		$query = $this->appendQuery($this->selectQuery, 'WHERE 1=1');
		$query = $this->appendQuery($query, 'ORDER BY lastname');
		return $this->parse($this->query($query, []));	
	}

	public function fetchById(array $ids) : array
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->selectQuery, "WHERE e.id IN ($ids)");
		$query = $this->appendQuery($query, 'ORDER BY lastname');
		return $this->parse($this->query($query, []));	
	}
	
	public function fetchByLogin(string $lastname, string $pass) : array
	{
		$query = "SELECT id FROM author WHERE lastname=:lastname AND pass=:pass";
		return $this->query($query, [':lastname' => $lastname, ':pass' => $pass]);
	}

}
