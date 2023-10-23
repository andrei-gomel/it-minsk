<?php

namespace Oleh\ItMinsk\Models;

use Oleh\ItMinsk\core\base\Model;

class Image extends Model
{
    protected string $table = 'images';

    public function saveImage(string $name, string $description, int $album_id, string $fileName): bool|int
    {
        $created_at = date('Y-m-d H:i:s');

        $user_id = $_SESSION['id'];

        $sql = "INSERT INTO `{$this->table}` SET `name` = :name, `description` = :description,
                `album_id` = :album_id, `created_at` = :created_at, `file_name` = :fileName";

        $result = $this->pdo->connection->prepare($sql);

        $result->bindParam(':name', $name, \PDO::PARAM_STR);

        $result->bindParam(':description', $description, \PDO::PARAM_STR);

        $result->bindParam(':album_id', $album_id, \PDO::PARAM_INT);

        $result->bindParam(':created_at', $created_at, \PDO::PARAM_STR);

        $result->bindParam(':fileName', $fileName, \PDO::PARAM_STR);

        $result->execute();

        // Получаем id вставленной записи
        $insert_id = $this->pdo->connection->lastInsertId();

        return $insert_id;
    }

    public function getImagesByIdAlbum(int $id): array
    {
        /*$sql2 = "SELECT images.id, images.name, images.description, images.album_id,  
                DATE_FORMAT(images.created_at, '%d.%m.%Y %H:%i') as date, images.file_name, 
                albums.name as album_name, albums.user_id
                FROM images JOIN albums 
                ON images.album_id=albums.id WHERE images.album_id = :id ORDER BY images.id ASC";*/

        $sql = "SELECT * FROM `{$this->table}` WHERE album_id = :id ORDER BY id ASC";

        $result = $this->pdo->connection->prepare($sql);

        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        $result->execute();

        $array = $result->fetchAll();

        return $array;
    }

    public function findOneWithAutor(int $id): array
    {
        $sql = "SELECT {$this->table}.id, {$this->table}.name, {$this->table}.description, {$this->table}.created_at, {$this->table}.file_name, 
                albums.name as album_name, users.name as autor
                FROM {$this->table}
                JOIN albums ON albums.id = {$this->table}.album_id 
                JOIN users ON albums.user_id = users.id 
                WHERE {$this->table}.id = :id";

        $result = $this->pdo->connection->prepare($sql);

        $result->bindParam(':id', $id, \PDO::PARAM_STR);

        $result->execute();

        $array = $result->fetch();

        if ($array === false)
            return false;

        return $array;
    }

}