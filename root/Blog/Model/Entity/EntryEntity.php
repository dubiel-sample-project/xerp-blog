<?php
namespace Blog\Model\Entity;

final class EntryEntity extends BaseEntity
{
	public function __construct()
	{
		$this->dataMap = array_flip(array(
			'id', 'title', 'published_date', 'text', 'fullname', 'email', 'url', 'comment_count', 'author', 'author_id'
		));
	}
}
