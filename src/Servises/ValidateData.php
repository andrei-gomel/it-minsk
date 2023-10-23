<?php

namespace Oleh\ItMinsk\Servises;

class ValidateData
{
    /*
    protected array $validateData;
    
    public function __construct($data)
    {
        $this->validateData = $data;
    }*/
    
    public static function checkLoginParams(array $data): array|bool
    {
        $_SESSION['loginError'] = [];

        if (!empty($data['email']) and !empty($data['password']))
        {
            $email = strip_tags(trim($data['email']));

            $pass = strip_tags(trim($data['password']));

            if(self::validate($email, $pass) === true)
                return $data;            
        }
        elseif (empty($data['email']) and !empty($data['password']))
        {
            //dd('Поле email не заполнено');
            $_SESSION['loginError'] = 'Необходимо ввести email';            
        }
        elseif (!empty($data['email']) and empty($data['password']))
        {
            //dd('Поле password не заполнено');
            $_SESSION['loginError'] = 'Необходимо ввести пароль';            
        }
        else
        {
            //dd('Поле email и password не заполнено');
            $_SESSION['loginError'] = 'Необходимо ввести email и пароль';            
        }

        if(isset($_SESSION['loginError']))
            return false;        
    }

    public static function validate(string $email, string $pass): bool
    {
        if(self::checkEmail($email) !== true)
        {
            $_SESSION['loginError'] = 'Е-майл не корректен';
              return false;
        }        

        if ((strlen($pass) < 6 OR strlen($pass) > 12)) 
        {
            $_SESSION['loginError'] = 'Пароль должен быть от 6 до 12 символов';
            return false;
        }

        return true;
    }

    public static function checkEmail(string $email): bool
    {
        $domain = substr(strrchr($email, "@"), 1);

        $exp = "/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_-]{2,5}(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i";

        if (!preg_match($exp, $email) and @!checkdnsrr($domain, "MX"))
        {
            return false;
        }

        return true;
    }
}