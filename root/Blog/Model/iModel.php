<?php
namespace Blog\Model;

interface iModel
{
	public function fetchAll();
	public function fetchById(array $arr);
	public function save(array $arr);
	public function edit(array $arr, string $id);
	public function delete(string $id);
}
