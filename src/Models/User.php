<?php

namespace Oleh\ItMinsk\Models;

use Oleh\ItMinsk\core\base\Model;
use stdClass;

class User extends Model
{
    public string $table = 'users';

    protected ?string $login;

    protected ?int $id;

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getUser(array $data): object|bool
    {

        $sql = "SELECT * FROM {$this->table} 
                WHERE email = :email AND password = :password";

        $email = $data['email'];
        
        $password = $data['password'];

        $result = $this->pdo->connection->prepare($sql);

        $result->bindParam(':email', $email, \PDO::PARAM_STR);

        $result->bindParam(':password', $password, \PDO::PARAM_STR);

        $result->execute();

        $array = (object)$result->fetch();

        if($array === false)
            return false;

        $this->pdo->connection = null;

        return $array;
    }
}