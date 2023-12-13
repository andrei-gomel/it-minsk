<?php

namespace Oleh\ItMinsk\Models;

use Oleh\ItMinsk\core\base\Model;

class Comment extends Model
{
    protected string $table = 'comments';

    public function saveComment(int $image_id, int $user_id, string $text): bool|int
    {
        $created_at = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO `{$this->table}` SET `image_id` = :image_id, `user_id` = :user_id,
                `text` = :text, `created_at` = :created_at";

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':image_id', $image_id, \PDO::PARAM_INT);

        $result->bindParam(':user_id', $user_id, \PDO::PARAM_INT);

        $result->bindParam(':text', $text, \PDO::PARAM_STR);

        $result->bindParam(':created_at', $created_at, \PDO::PARAM_STR);

        $result->execute();

        // Получаем id вставленной записи
        $insert_id = $this->pdo->connect->lastInsertId();

        return $insert_id;
    }

    public function findCommentByImageId(int $id): array
    {              
        $sql = "SELECT {$this->table}.text, {$this->table}.created_at, users.name as autor 
                FROM {$this->table} 
                JOIN users ON {$this->table}.user_id = users.id 
                WHERE {$this->table}.image_id = :id ORDER BY {$this->table}.id ASC";

        $result = $this->pdo->connect->prepare($sql);

        $result->bindParam(':id', $id, \PDO::PARAM_STR);

        $result->execute();

        $array = $result->fetchAll();

        if ($array === false)
            return false;

        return $array;
    }
}
