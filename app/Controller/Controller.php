<?php

namespace App\Controller;

use App\Router\Router;
use App\View\View;

class Controller
{
    private $router;
    private $view;

    public function __construct()
    {
        $this->router = new Router();
        $this->view = new View();
    }

    public function proceed_request()
    {
        $component = $this->router->route();
        $this->proceed_component($component);
        $this->view->show();
    }

    private function proceed_component($component_data)
    {
        if ($component_data) {
            $this->view->set_title($component_data['title']);
            switch ($component_data['type']) {
                case 'module':
                {
                    if (
                        class_exists($component_clas = $component_data['class']) &&
                        method_exists($component_clas, $method = $component_data['method'])
                    ) {
                        $component_object = new $component_clas();
                        $proceed_data = $component_object->$method();
                        $this->view->proceed_template($proceed_data['template'], $proceed_data);
                    }
                    break;
                }
                default:
                case 'template':
                {
                    $this->view->proceed_template($component_data['template']);
                    break;
                }
            }
        }
    }
}