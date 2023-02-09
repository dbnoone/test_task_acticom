<?php

namespace App\Modules\File;

use App\Tools\Templates\Templates;

class File
{
    private $storage_path;
    private $file_data;

    public $path;

    public function __construct($file_data)
    {
        $this->storage_path = PROJECT_ROOT . 'files_storage/';
        $this->file_data = $file_data;
    }

    public function move_to_storage()
    {
        $result = false;
        $filename = $this->generate_filename($this->file_data['name']);
        $file_extension = $this->get_file_extension($this->file_data['name']);
        if (!file_exists($this->storage_path)) {
            mkdir($this->storage_path);
        }
        $full_file_path = $this->storage_path . $filename . '.' . $file_extension;
        if (!file_exists($full_file_path)) {
            move_uploaded_file($this->file_data['tmp_name'], $full_file_path);
            $result = true;
            $this->path = $full_file_path;
        } else {
            Templates::add_alert('danger', 'Не получилось загрузить файл, попробуйте еще раз');
        }
        return $result;
    }

    private function generate_filename($file_name)
    {
        return rand(0, 100) . md5($file_name) . time();
    }

    private function get_file_extension($file_name)
    {
        return substr(strrchr($file_name, '.'), 1);
    }

    public function delete_file()
    {
        return unlink($this->path);
    }
}