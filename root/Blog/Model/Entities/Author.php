<?php
namespace Blog\Model\Entities;

final class Author extends Base
{
	public function __construct()
	{
		$this->dataMap = array_flip(array(
			'id', 'firstname', 'lastname', 'fullname', 'email', 'url'
		));
	}
}
