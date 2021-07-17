<?php
namespace Blog\Model;
use Blog\Model\Entities\BaseEntity;

final class EntryModel extends BaseModel implements iModel
{
	private $selectQuery;
	
	protected function getEntity() : BaseEntity
	{
		return new Entities\EntryEntity();		
	}
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = 'entry';
		$this->selectQuery = "
				SELECT e.id, e.title, e.published_date, LEFT(e.text, 1000) as text, concat(a.firstname, ' ', a.lastname) as fullname, 
					a.email, a.url, c.comment_count, a.id as author_id FROM entry e INNER JOIN author a ON e.author = a.id LEFT JOIN (SELECT entry, count(1) as comment_count FROM comment GROUP BY entry) c 
					on e.id = c.entry
				"; 
	}
	
	public function fetchAll() : array
	{
		$query = $this->appendQuery($this->selectQuery, 'WHERE 1=1');
		$query = $this->appendQuery($query, 'ORDER BY e.published_date DESC');
		$query = $this->appendQuery($query, 'LIMIT 0,3');
		return $this->parse($this->query($query, []));	
	}

	public function fetchById(array $ids) : array
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->selectQuery, "WHERE e.id IN ($ids)");
		$query = $this->appendQuery($query, 'ORDER BY e.published_date DESC');
		return $this->parse($this->query($query, []));	
	}
	
	public function fetchByAuthor(array $ids) : array
	{
		$ids = implode(',', $ids);
		$query = $this->appendQuery($this->selectQuery, "WHERE a.id IN ($ids)");
		$query = $this->appendQuery($query, 'ORDER BY e.published_date DESC');
		return $this->parse($this->query($query, []));	
	}
	
	public function fetchBySearch($term): array
	{
		$query = $this->appendQuery($this->selectQuery, 'WHERE e.text like :term');
		$query = $this->appendQuery($query, 'ORDER BY e.published_date DESC');
		return $this->parse($this->query($query, [':term' => "%$term%"]));	
	}
     
}