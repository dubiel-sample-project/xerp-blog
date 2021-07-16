<?php
namespace Blog\Model;

final class Author extends Base implements iModel
{
	private $selectQuery;
	
	protected function getEntity()
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
	
	public function fetchAll()
	{
		$query = $this->appendQuery($this->selectQuery, 'WHERE 1=1');
		$query = $this->appendQuery($query, 'ORDER BY lastname');
		return $this->parse($this->query($query, []));	
	}

	public function fetchById(array $ids)
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->selectQuery, "WHERE e.id IN ($ids)");
		$query = $this->appendQuery($query, 'ORDER BY lastname');
		return $this->parse($this->query($query, []));	
	}
	
	public function fetchByLogin(string $name, string $pass)
	{
		
		$row = mysql_fetch_row($this->query(sprintf("SELECT id FROM author WHERE lastname='%s' AND pass='%s'",
            mysql_real_escape_string($name),
            mysql_real_escape_string($pass))));

		return $row[0];
	}

}
