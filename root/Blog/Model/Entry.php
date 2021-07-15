<?php
namespace Blog\Model;

final class Entry extends Base implements iModel
{
	private $selectQuery;
	
	protected function getEntity()
	{
		return new Entities\Entry();		
	}
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = 'entry';
		$this->selectQuery = "
				SELECT e.id, e.title, e.published_date, LEFT(e.text, 1000) as text, concat(a.firstname, ' ', a.lastname) as fullname, 
					a.email, a.url, c.comment_count, a.id as author_id FROM entry e INNER JOIN author a ON e.author = a.id LEFT JOIN (SELECT entry, count(1) as comment_count FROM comment GROUP BY entry) c 
					on e.id = c.entry %s %s %s
			"; 
	}
	
	public function fetchAll()
	{
		$query = sprintf($this->selectQuery, "WHERE 1=1", "ORDER BY e.published_date DESC", "LIMIT 0,3");
		return $this->parse($this->query($query));	
	}

	public function fetchById($ids)
	{
		$ids = implode(',', $ids);
		$query = sprintf($this->selectQuery, "WHERE e.id IN ($ids)", "ORDER BY e.published_date DESC", "");
		return $this->parse($this->query($query));	
	}
	
	public function fetchByAuthor($ids)
	{
		$ids = implode(',', $ids);
		$query = sprintf($this->selectQuery, "WHERE a.id IN ($ids)", "ORDER BY e.published_date DESC", "");
		return $this->parse($this->query($query));	
	}
	
	public function fetchBySearch($term)
	{
		$term = mysql_real_escape_string($term);
		$query = sprintf($this->selectQuery, "WHERE e.text like '%$term%'", "ORDER BY e.published_date DESC", "");
		
		return $this->parse($this->query($query));	
	}
        
}
