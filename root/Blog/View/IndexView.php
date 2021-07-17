<?php
namespace Blog\View;

final class IndexView extends BaseView implements iView
{
	public function __construct()
	{
		$this->partialName = 'index.phtml';
	}
}
