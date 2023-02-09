<?php

namespace App\Tools\Templates;

class Templates
{
    private static $alerts;

    public static function add_alert($type, $message)
    {
        self::$alerts[] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public static function get_alerts()
    {
        return self::$alerts;
    }
}