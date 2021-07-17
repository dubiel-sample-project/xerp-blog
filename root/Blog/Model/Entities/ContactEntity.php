<?php
namespace Blog\Model\Entities;

final class ContactEntity extends BaseEntity
{
	public function __construct()
	{
		$this->dataMap = array_flip(array(
			'id', 'author', 'email', 'message'
		));
	}
}
