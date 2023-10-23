<?php

namespace Oleh\ItMinsk\core\base;

use Oleh\ItMinsk\core\Db;

abstract class Model
{
	public object $pdo;
	protected string $table;
	protected string $pk = 'id';

	public function __construct()
	{
    		$this->pdo = Db::instance();	
	}

	public function query($sql)
	{
		return $this->pdo->connection->execute($sql);
	}

	public function findAll()
	{
     		$sql = "SELECT * FROM {$this->table}";

     		return $this->pdo->query($sql);
	}

	public function findOne($id, $field = '')
	{
		$field = $field ?: $this->pk;

		$sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";

		return $this->pdo->query($sql, [$id]);
	}	

}
