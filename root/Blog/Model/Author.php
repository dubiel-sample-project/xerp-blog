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
				SELECT id, concat(firstname, ' ', lastname) as fullname, email, url FROM author %s %s %s
			"; 
	}
	
	public function fetchAll()
	{
		$query = sprintf($this->selectQuery, "WHERE 1=1", "ORDER BY lastname", "");
		return $this->parse($this->query($query));	
	}

	public function fetchById($ids)
	{
		$ids = implode(',', $ids);
		$query = sprintf($this->selectQuery, "WHERE id IN ($ids)", "ORDER BY lastname", "");
		return $this->parse($this->query($query));	
	}
	
	public function fetchByLogin($name, $pass)
	{
		
		$row = mysql_fetch_row($this->query(sprintf("SELECT id FROM author WHERE lastname='%s' AND pass='%s'",
            mysql_real_escape_string($name),
            mysql_real_escape_string($pass))));

		return $row[0];
	}

}
