<?php
namespace Blog\View;

final class Author extends Base implements iView
{
	public function __construct()
	{
		$this->partialName = 'author.phtml';
	}
}
