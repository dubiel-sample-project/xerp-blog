<?php
namespace Blog\Model\Entity;

final class CommentEntity extends BaseEntity
{
	public function __construct()
	{
		$this->dataMap = array_flip(array(
			'id', 'name', 'content', 'title', 'email', 'url', 'entry'
		));
	}
}
