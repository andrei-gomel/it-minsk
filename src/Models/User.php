<?php

namespace Oleh\ItMinsk\Models;

use Oleh\ItMinsk\core\base\Model;
use PDO;

class User extends Model
{
    public string $table = 'users';

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    
    public function getUser(array $data): object|bool
    {

        $sql = "SELECT `id`, `login`, `name` FROM {$this->table} 
                WHERE `email` = :email AND `password` = :password";

        $email = $data['email'];
        
        $password = $data['password'];

        $options = [
            ':email' => $email,
            ':password' => $password,
        ];

        $stmt = $this->pdo->connect->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Oleh\ItMinsk\Models\User');

        $stmt->execute($options);        

        $array = $stmt->fetch();

        if($array === false)
            return false;

        return $array;
    }
}
