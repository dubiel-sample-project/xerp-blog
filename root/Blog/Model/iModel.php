<?php
namespace Blog\Model;

interface iModel
{
	public function fetchAll() : array;
	public function fetchById(array $arr) : array;
	public function save(array $arr);
	public function edit(array $arr, string $id);
	public function delete(string $id);
}
