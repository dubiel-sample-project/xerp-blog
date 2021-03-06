<?php
namespace Blog\Model\Entity;

final class AuthorEntity extends BaseEntity
{
	public function __construct()
	{
		$this->dataMap = array_flip(array(
			'id', 'firstname', 'lastname', 'fullname', 'email', 'url', 'password'
		));
	}
}
