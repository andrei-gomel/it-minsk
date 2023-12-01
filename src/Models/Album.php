<?php

namespace Oleh\ItMinsk\Models;

use Oleh\ItMinsk\core\base\Model;

class Album extends Model
{
    protected string $table = 'albums';

    public function saveAlbum(string $name, string $description): bool|int
    {
        $created_at = date('Y-m-d H:i:s');

        $user_id = $_SESSION['id'];
        
        $sql = "INSERT INTO `{$this->table}` SET `name` = :name, `description` = :description,
                `user_id` = :user_id, `created_at` = :created_at";

        $result = $this->pdo->connection->prepare($sql);

        $result->bindParam(':name', $name, \PDO::PARAM_STR);

        $result->bindParam(':description', $description, \PDO::PARAM_STR);

        $result->bindParam(':user_id', $user_id, \PDO::PARAM_INT);

        $result->bindParam(':created_at', $created_at, \PDO::PARAM_STR);

        $result->execute();

        // Получаем id вставленной записи
        $insert_id = $this->pdo->connection->lastInsertId();

        return $insert_id;
    }

    public function getAlbumsWithAutor(): array
    {
        $sql = "SELECT id, name, created_at, 
            (SELECT name FROM users 
                WHERE users.id={$this->table}.user_id) AS autor, 
            (SELECT file_name FROM images 
                WHERE images.album_id={$this->table}.id 
                ORDER BY images.id ASC LIMIT 1) AS file_name 
            FROM {$this->table}";

        $result = $this->pdo->connection->prepare($sql);

        $result->execute();

        $array = $result->fetchAll();

        if ($array === false)
            return false;

        return $array;
    }
}
