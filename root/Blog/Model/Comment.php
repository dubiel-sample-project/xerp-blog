<?php
namespace Blog\Model;

final class Comment extends Base implements iModel
{
	private $selectQuery;
	
	protected function getEntity()
	{
		return new Entities\Comment();		
	}
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = 'comment';
		$this->selectQuery = "
				SELECT id, name, email, url, title, content, entry FROM comment %s %s %s
			"; 
	}
	
	public function fetchAll()
	{
		$query = sprintf($this->selectQuery, "WHERE 1=1", "", "");
		return $this->parse($this->query($query));	
	}

	public function fetchById($ids)
	{
		$ids = implode(',', $ids);
		$query = sprintf($this->selectQuery, "WHERE id IN ($ids)", "", "");
		return $this->parse($this->query($query));	
	}
	
	public function fetchByEntry($ids)
	{
		$ids = implode(',', $ids);
		$query = sprintf($this->selectQuery, "WHERE entry IN ($ids)", "", "");
		return $this->parse($this->query($query));	
	}
        
}
