<?php
namespace Blog\View;

final class ContactView extends BaseView implements iView
{
	public function __construct()
	{
		$this->partialName = 'contact.phtml';
	}
}
