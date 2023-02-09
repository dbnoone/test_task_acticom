<?php

namespace App\Modules\Products;

use App\DB\DB;
use App\Modules\File\File;
use App\Tools\Request\Request;
use App\Tools\Templates\Templates;

class Products
{
    public function load()
    {
        $data = [
            'template' => 'load'
        ];
        if ($file_data = Request::get_file('user_file')) {
            $file = new File($file_data);
            if ($file->move_to_storage()) {
                $list = $this->read_file($file->path);
                if ($data) {
                    Templates::add_alert('success', 'Успешно обработано ' . $list . ' записей');
                    $data = $this->list();
                }
                $file->delete_file();
            }
        }
        return $data;
    }

    public function list()
    {
        $data = [
            'template' => 'list'
        ];
        $db = new DB();
        $data['list'] = $db->load('products');
        return $data;
    }


    private function read_file($file_path)
    {
        $result = false;
        $file_stream = fopen($file_path, 'r');
        $data_array = [];
        // пропускаем первую строку
        stream_get_line($file_stream, 0, PHP_EOL);
        while ($line = stream_get_line($file_stream, 0, PHP_EOL)) {
            // файл кривой, чистим от бесполезных символов, которые портят данные - пробелы, запятые, кавычки
            $line = trim(trim($line), ',');
            $buffer = str_replace('"', '', $line);
            $buffer = str_getcsv($buffer, ';');
            // некоторые строки обладают большим колвом колонок - удаляем лишние
            if (count($buffer) > 14) {
                while (count($buffer) > 14) {
                    array_pop($buffer);
                }
            }
            $data_array[] = $buffer;
        }

        if ($data_array) {
            $db = new DB();
            $db->clear('products');
            $db->create('products', $data_array);
            $result = count($data_array);
        }
        return $result;
    }
}