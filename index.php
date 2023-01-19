<?php

use App\Controllers\couponController;
use App\Core\Request;
use App\Core\Routes\Route;
use App\Core\Routes\Router;
use App\Models\Contracts\mysqlBaseModel;
use App\Models\imageModel;
use App\Utilities\Assets;

include_once 'bootstrap/init.php';
$router = new Router;
$router->runRouter();


// $ss->expireCoupon('30');