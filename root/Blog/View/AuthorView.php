<?php
namespace Blog\View;

final class AuthorView extends BaseView implements iView
{
	public function __construct()
	{
		$this->partialName = 'author.phtml';
	}
}
