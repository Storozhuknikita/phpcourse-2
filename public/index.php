<?php
include '../vendor/autoload.php';
$config = include('../main/config.php');
\App\main\App::call()->run($config);