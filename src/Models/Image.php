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

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':name', $name, \PDO::PARAM_STR);

        $result->bindParam(':description', $description, \PDO::PARAM_STR);

        $result->bindParam(':album_id', $album_id, \PDO::PARAM_INT);

        $result->bindParam(':created_at', $created_at, \PDO::PARAM_STR);

        $result->bindParam(':fileName', $fileName, \PDO::PARAM_STR);

        $result->execute();

        // Получаем id вставленной записи
        $insert_id = $this->pdo->connect->lastInsertId();

        if ($insert_id === 0)
            return false;

        return $insert_id;
    }

    public function getImagesByIdAlbum(int $id): array|bool
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE album_id = :id ORDER BY id ASC";

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        $result->execute();

        $array = $result->fetchAll();

        if ($array === false)
            return false;

        return $array;
    }

    public function findOneWithAutor(int $id): array|bool
    {
        $sql = "SELECT {$this->table}.id, {$this->table}.name, {$this->table}.description, {$this->table}.created_at, {$this->table}.file_name, 
                albums.name as album_name, users.name as autor
                FROM {$this->table}
                JOIN albums ON albums.id = {$this->table}.album_id 
                JOIN users ON albums.user_id = users.id 
                WHERE {$this->table}.id = :id";

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':id', $id, \PDO::PARAM_STR);

        $result->execute();

        $array = $result->fetch();

        if ($array === false)
            return false;

        return $array;
    }
}
