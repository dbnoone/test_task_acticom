<?php

use App\Controller\Controller;

require 'vendor/autoload.php';

define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

$controller = new Controller();
$controller->proceed_request();