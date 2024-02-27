<?php

session_start();

use routes\routes;

require_once '../vendor/autoload.php';
require_once '../config/config.php';

$dotenv =\Dotenv\Dotenv::createImmutable(dirname(__DIR__,1));
$dotenv->safeLoad();

routes::index();