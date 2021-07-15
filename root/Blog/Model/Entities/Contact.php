<?php
namespace Blog\Model\Entities;

final class Contact extends Base
{
	public function __construct()
	{
		$this->dataMap = array_flip(array(
			'id', 'author', 'email', 'message'
		));
	}
}
