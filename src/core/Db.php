<?php

namespace Oleh\ItMinsk\core;

use PDOException;

use PDO;

class Db
{
	//use TSingleton;

	public $connection;
	protected static $instance;
	public static $countSql = 0;
	public static $queries = [];

	public function __construct()
	{
		$db = require_once ROOT . '/config/config_db.php';
		$options = [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION,
		];

        try
        {
            $this->connection = new PDO($db['dsn'], $db['user'], $db['pass'], $options);

        }
        catch(PDOException $exception)
        {
            dd("ERROR: {$exception->getMessage()}");
        }
		
		//$this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass']);
	}

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function execute($sql, $params = []): array
    {
        //self::$countSql++;
        //self::$queries[] = $sql;
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute($params);
    }

    public function query($sql, $params = [])
    {
        //self::$countSql++;
        //self::$queries[] = $sql;

        $stmt = $this->connection->prepare($sql);

        $res = $stmt->execute($params);

        if ($res !== false) {
            return $stmt->fetchAll();
        }

        return [];
    }
}