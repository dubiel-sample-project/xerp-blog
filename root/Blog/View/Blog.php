<?php
namespace Blog\View;

final class Blog extends Base
{
	public function __construct()
	{
		$this->partialName = 'blog.phtml';
	}
}
