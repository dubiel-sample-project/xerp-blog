<?php
namespace Blog\Model\Entities;

final class Comment extends Base
{
	public function __construct()
	{
		$this->dataMap = array_flip(array(
			'id', 'name', 'content', 'title', 'email', 'url', 'entry'
		));
	}
}
