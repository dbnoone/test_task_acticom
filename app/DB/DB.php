<?php

namespace App\DB;

use App\Tools\Config\Config;
use mysqli;
use mysqli_sql_exception;

class DB
{
    /** @var mysqli */
    private $connection = false;

    public function __construct() {}

    public function query($query_string)
    {
        $result = false;
        if ($this->connect()) {
            $result = $this->connection->query($query_string);
        }
        $this->disconnect();

        return $result;
    }

    private function connect()
    {
        $result = false;
        $db_params = Config::get('db', 'mysql');
        if (
            isset($db_params['host']) && isset($db_params['pass'])
            && isset($db_params['login']) && isset($db_params['db_name'])
            && isset($db_params['port'])
        ) {
            try {
                $this->connection = new mysqli(
                    $db_params['host'], $db_params['login'],
                    $db_params['pass'], $db_params['db_name'],
                    $db_params['port']
                );
                $result = true;
            } catch (mysqli_sql_exception $e) {
                var_dump($e->getMessage());
                die();
            }

        }

        return $result;
    }

    private function disconnect()
    {
        return $this->connection->close();
    }

    public function load($table)
    {
        $query_string = 'SELECT * FROM `' . $table . '`';
        return $this->query($query_string)->fetch_all(MYSQLI_ASSOC);
    }

    public function create($table, $data)
    {
        $query_string = $this->prepare_query_string('insert', $table, $data);
        $this->query($query_string);
    }

    public function clear($table)
    {
        $this->query('TRUNCATE TABLE `' . $table . '`');
    }

    private function prepare_query_string(
        $query_type = 'select', $table = false,
        $data = false, $limit = false,
        $start = false, $order = false
    )
    {
        $query_string = '';
        if ($query_type) {
            switch ($query_type) {
                case 'select':
                {
                    $query_string = 'SELECT * FROM `' . $table . '` ';
                    $query_string .= $limit ? ($start ? 'LIMIT ' . $start . ',' . $limit . ' ' : 'LIMIT ' . $limit . ' ') : '';
                    if ($order) {
                        $order_explode = explode('_', $order);
                        $query_string .= 'ORDER BY ' . $order_explode[0] . ' ' . strtoupper($order_explode[1]);
                    }
                    break;
                }
                case 'insert':
                {
                    if ($data) {
                        $structure = Config::get('db_structures');
                        if (isset($structure[$table])) {
                            $fields = $structure[$table];
                            $query_string .= 'INSERT INTO `' . $table . '` (';
                            $fields = array_keys($fields);
                            $query_string .= implode(', ', $fields) . ') VALUES ';
                            $insert_data = [];
                            foreach ($data as $data_piece) {

                                $data_piece = $this->injection_prepare($data_piece, $table);
                                $insert_data[] = '(' . implode(',', $data_piece) . ')';
                            }
                            $query_string .= implode(',', $insert_data);
                        }
                    }
                    break;
                }
            }
        }

        return $query_string;
    }

    private function injection_prepare($array_data, $table)
    {
        $structure = array_values(Config::get('db_structures', $table));
        foreach ($array_data as $key => $value) {
            $rules = $structure[$key] ?? $structure[$key - 1];
            if ($rules) {
                if ($value) {
                    switch ($rules) {
                        case 'int':
                        {
                            $value = (int)$value;
                            break;
                        }
                        default:
                        case 'string':
                        {
                            $value = (string)$value;
                            $value = '"' . addslashes($value) . '"';
                            break;
                        }
                    }
                } else {
                    switch ($rules) {
                        case 'int':
                        {
                            $value = $rules['default'];;
                            break;
                        }
                        default:
                        case 'string':
                        {
                            $value = '"' . $rules['default'] . '"';
                            break;
                        }
                    }
                }
                $array_data[$key] = $value;
            }
        }
        return $array_data;
    }
}