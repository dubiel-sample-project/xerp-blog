<?php
namespace Blog\Model;
use Blog\Model\Entities\BaseEntity;

final class Comment extends BaseModel implements iModel
{
	private $selectQuery;
	
	protected function getEntity() : BaseEntity 
	{
		return new Entities\CommentEntity();		
	}
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = 'comment';
		$this->selectQuery = "
				SELECT id, name, email, url, title, content, entry FROM comment
			"; 
	}
	
	public function fetchAll() : array
	{
		$query = $this->appendQuery($this->selectQuery, 'WHERE 1=1');
		return $this->parse($this->query($query, []));	
	}

	public function fetchById(array $ids) : array
	{
		return $this->fetch($ids);
	}
	
	public function fetchByEntry(array $ids) : array
	{
		return $this->fetch($ids);
	}
        
	private function fetch(array $ids) : array
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->selectQuery, 'WHERE e.id IN ($ids)');
		return $this->parse($this->query($query, []));
	}	
}
