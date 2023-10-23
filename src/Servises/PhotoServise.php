<?php

namespace Oleh\ItMinsk\Servises;

class PhotoServise
{
    public static function uploadPhoto(array $file, string $imgName): bool
    {
        $fileType = explode('/', $file['type']);
        
        if (is_uploaded_file($file['tmp_name']))
        {           
            if(move_uploaded_file($file['tmp_name'], ROOT . "/public/upload/images/{$imgName}.{$fileType[1]}"))
                return true;
        }     
        else
        {
            return false;
        }
    }

    public static function createImageName($data): string
    {
        $imgName = explode('.', $data['name']);

        $imgName = hash('ripemd160', $imgName[0]);

        $fileType = explode('/', $data['type']);

        $imgName = $imgName . '.' . $fileType[1];

        return $imgName;
    }
}