<?php

namespace Oleh\ItMinsk\core;

use PDOException;

use PDO;

class Db
{
	public $connect;

	protected static $instance;

	public function __construct()
	{
		$db = require_once ROOT . '/config/config_db.php';

		$options = [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
		];

        try
        {
            $this->connect = new PDO($db['dsn'], $db['user'], $db['pass'], $options);
        }
        catch(PDOException $exception)
        {
            dd("ERROR: {$exception->getMessage()}");
        }

	}

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function execute($sql, $params = []): array|bool
    {
        $stmt = $this->connect->prepare($sql);

        return $stmt->execute($params);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->connect->prepare($sql);

        $res = $stmt->execute($params);

        if ($res !== false) {
            return $stmt->fetchAll();
        }

        return [];
    }
}
