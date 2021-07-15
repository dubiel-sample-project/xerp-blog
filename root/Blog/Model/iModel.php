<?php
namespace Blog\Model;

interface iModel
{
	public function fetchAll();
	public function fetchById($arr);
	public function save($arr);
	public function edit($arr, $id);
	public function delete($id);
}
