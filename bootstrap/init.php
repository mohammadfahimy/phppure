<?php

use App\Core\Request;
define('BASEURI','http://localhost/proje/');
define('BASEPATH',dirname(__DIR__));
define('ASSETURI',BASEURI.'/Assets/');
session_start();

include_once BASEPATH.'/vendor/autoload.php';

include_once BASEPATH.'/helper/helper.php';
include_once BASEPATH.'/Route/web.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASEPATH);
$dotenv->load();
$request = new Request();