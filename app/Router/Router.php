<?php

namespace App\Router;

use App\Tools\Config\Config;
use App\Tools\Request\Request;

class Router
{
    public function route()
    {
        $result = false;
        $allow_routes = Config::get('routes');
        if ($allow_routes) {
            $url = Request::get_url();
            $result = $allow_routes[$url] ?? $allow_routes['/404'];
        }
        return $result;
    }
}