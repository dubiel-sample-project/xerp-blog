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
				SELECT id, name, email, url, title, content, entry FROM comment
			"; 
	}
	
	public function fetchAll()
	{
		$query = $this->appendQuery($this->selectQuery, 'WHERE 1=1');
		return $this->parse($this->query($query, []));	
	}

	public function fetchById(array $ids)
	{
		return $this->fetch($ids);
	}
	
	public function fetchByEntry(array $ids)
	{
		return $this->fetch($ids);
	}
        
	private function fetch(array $ids)
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->selectQuery, 'WHERE e.id IN ($ids)');
		return $this->parse($this->query($query, []));
	}	
}
