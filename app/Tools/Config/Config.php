<?php

namespace App\Tools\Config;

class Config
{

    static private $config_path = PROJECT_ROOT . 'app/Configs/';

    /**
     * Ищет конфиг по имени
     *
     * @param $config_name
     * @param $section_name
     * @return array|false
     */
    public static function get($config_name, $section_name = false): array|false
    {
        $result = false;
        if ($config_name) {
            $config_name = trim(strtolower($config_name));
            if (file_exists($file_path = self::$config_path . $config_name . '_config.php')) {
                require($file_path);
                if (isset($config)) {
                    if ($section_name) {
                        $result = $config[$section_name] ?? $config;
                    } else {
                        $result = $config;
                    }
                }
            }
        }
        return $result;
    }
}