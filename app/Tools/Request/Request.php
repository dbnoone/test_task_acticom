<?php

namespace App\Tools\Request;

class Request
{
    public static function get_url()
    {
        return explode('?', $_SERVER['REQUEST_URI'])[0];
    }

    public static function get_file($file_name)
    {
        return $_FILES[$file_name] ?? false;
    }
}