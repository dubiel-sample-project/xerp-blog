<?php
namespace Blog\View;

final class SearchView extends BaseView implements iView
{
	public function __construct()
	{
		$this->partialName = 'search.phtml';
	}
}
