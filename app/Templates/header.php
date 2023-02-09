<?php
/** @var $this View */

use App\Tools\Request\Request;
use App\View\View;

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"></script>
    <title><?= $this->title ?></title>
</head>
<body class="">

<header class="navbar navbar-expand-md db-navbar navbar-light">
    <div class="container-xxl flex-wrap flex-md-nowrap">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav pt-2 py-md-0">
                <li class="nav-item col-6 col-md-auto">
                    <a href="/load"
                       class="nav-link p-2 <?= isset($this->data['template']) ? ($this->data['template'] == 'load' ? 'active' : '') : '' ?>">
                        Загрузка файла
                    </a>
                </li>
                <li class="nav-item col-6 col-md-auto">
                    <a href="/list"
                       class="nav-link p-2 <?= isset($this->data['template']) ? ($this->data['template'] == 'list' ? 'active' : '') : '' ?>">
                        Загруженные данные
                    </a>
                </li>
                <li></li>
            </ul>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="container">