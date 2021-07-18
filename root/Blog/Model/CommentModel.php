<?php
namespace Blog\Model;
use Blog\Model\Entities\BaseEntity;

final class CommentModel extends BaseModel implements iModel
{
	protected function getEntity() : BaseEntity 
	{
		return new Entities\CommentEntity();		
	}
	
	protected function getSelectQuery() : string
	{
		return "SELECT id, name, email, url, title, content, entry FROM comment"; 
	}
	
	protected function getTableName() : string
	{
		return 'comment';
	}
	
	public function fetchAll() : array
	{
		$query = $this->appendQuery($this->getSelectQuery(), 'WHERE 1=1');
		return $this->parse($this->query($query, []));	
	}

	public function fetchById(string $id) : BaseEntity
	{
		return current($this->fetch([$id]));
	}
	
	public function fetchByEntry(array $ids) : array
	{
		return $this->fetch($ids);
	}
        
	private function fetch(array $ids) : array
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->getSelectQuery(), "WHERE entry IN ($ids)");
		$query = $this->appendQuery($query, "ORDER BY id DESC");
		return $this->parse($this->query($query, []));
	}	
}
