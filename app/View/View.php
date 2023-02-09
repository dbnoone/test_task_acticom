<?php

namespace App\View;

use App\Tools\Templates\Templates;

class View
{

    private $tempaltes_path;
    private $output;
    private $title;

    private $data;

    private $alerts;

    public function __construct()
    {
        $this->tempaltes_path = PROJECT_ROOT . 'app/Templates/';
        $this->output = '';
    }

    public function proceed_template($template_name, $data = false)
    {
        $result = false;
        $this->data = false;
        if ($template_name) {
            if ($data) {
                $this->data = $data;
            }
            if ($template_path = $this->search_template($template_name)) {
                $this->template_to_output($template_path);
                $result = true;
            }
        }

        return $result;
    }

    private function search_template($template_name)
    {
        $result = false;
        if ($template_name) {
            if (file_exists($template_path = $this->tempaltes_path . $template_name . '.php')) {
                $result = $template_path;
            }
        }

        return $result;
    }

    private function template_to_output($template_path, $append = false)
    {
        ob_start();
        require($template_path);
        if ($append) {
            $buffer = $this->output;
            $this->output = ob_get_contents();
            $this->output .= $buffer;
        } else {
            $this->output .= ob_get_contents();
        }
        ob_end_clean();
    }

    public function show()
    {
        $this->alerts = Templates::get_alerts();
        $header_template = $this->tempaltes_path . 'header.php';
        $this->template_to_output($header_template, true);
        $footer_template = $this->tempaltes_path . 'footer.php';
        $this->template_to_output($footer_template);

        echo $this->output;
    }

    public function set_title($title)
    {
        $this->title = $title;
    }

    public function set_alert($type, $message)
    {
        $this->alerts[] = [
            'type' => $type,
            'message' => $message
        ];
    }
}