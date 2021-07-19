<?php
namespace Blog\Model;
use Blog\Model\Entity\BaseEntity;

interface iModel
{
	public function fetchAll() : array;
	public function fetchById(string $id) : BaseEntity;
	public function save(array $arr);
	public function edit(array $arr, string $id);
	public function delete(string $id);
}
