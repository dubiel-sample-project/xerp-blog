<?php
namespace Blog\View;

final class BlogView extends BaseView implements iView
{
	public function __construct()
	{
		$this->partialName = 'blog.phtml';
	}
}
