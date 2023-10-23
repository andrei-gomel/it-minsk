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
        $sql = "SELECT {$this->table}.id, {$this->table}.name, {$this->table}.created_at, {$this->table}.user_id, users.name  as autor
                FROM {$this->table} 
                JOIN users ON {$this->table}.user_id = users.id ORDER BY {$this->table}.id ASC";

        /*$sql2 = "SELECT albums.id, albums.name, albums.created_at, users.name as autor, images.file_name
                FROM albums 
                JOIN users ON albums.user_id = users.id 
                LEFT JOIN images ON images.album_id=albums.id
                ORDER BY albums.id ASC";*/

        $result = $this->pdo->connection->prepare($sql);

        $result->execute();

        $array = $result->fetchAll();

        if ($array === false)
            return false;

        return $array;
    }

/*
SELECT albums.id, albums.name, albums.created_at, users.name as autor, images.file_name
FROM albums 
JOIN users ON albums.user_id = users.id 
LEFT JOIN images ON images.album_id=albums.id
ORDER BY albums.id ASC;
*/

}