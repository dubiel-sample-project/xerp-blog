<?php
namespace Blog\Model;
use Blog\Model\Entity\BaseEntity;

final class EntryModel extends BaseModel implements iModel
{
	protected function getEntity() : BaseEntity
	{
		return new Entity\EntryEntity();		
	}
	
	protected function getSelectQuery() : string
	{
		return "
				SELECT e.id, e.title, e.published_date, LEFT(e.text, 1000) as text, concat(a.firstname, ' ', a.lastname) as fullname, 
					a.email, a.url, c.comment_count, a.id as author_id FROM entry e INNER JOIN author a ON e.author = a.id LEFT JOIN (SELECT entry, count(1) as comment_count FROM comment GROUP BY entry) c 
					on e.id = c.entry
				"; 
	}
	
	protected function getTableName() : string
	{
		return 'entry';
	}
	
	public function fetchAll() : array
	{
		$query = $this->appendQuery($this->getSelectQuery(), 'WHERE 1=1');
		$query = $this->appendQuery($query, 'ORDER BY e.published_date DESC');
		$query = $this->appendQuery($query, 'LIMIT 0,3');
		return $this->parse($this->query($query, []));	
	}

	public function fetchById(string $id) : BaseEntity
	{
		$query = $this->appendQuery($this->getSelectQuery(), "WHERE e.id = :id");
		return current($this->parse($this->query($query, [':id' => $id])));	
	}
	
	public function fetchByTitle(string $title) : array
	{
		$query = $this->appendQuery($this->getSelectQuery(), "WHERE e.title = :title");
		return $this->parse($this->query($query, [':title' => $title]));	
	}
	
	public function fetchByAuthor(array $ids) : array
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->getSelectQuery(), "WHERE a.id IN ($ids)");
		$query = $this->appendQuery($query, 'ORDER BY e.published_date DESC');
		return $this->parse($this->query($query, []));	
	}
	
	public function fetchBySearch($term): array
	{
		$query = $this->appendQuery($this->getSelectQuery(), 'WHERE e.text like :term');
		$query = $this->appendQuery($query, 'ORDER BY e.published_date DESC');
		return $this->parse($this->query($query, [':term' => "%$term%"]));	
	}
     
}
