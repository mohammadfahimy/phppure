<?php

namespace App\Core;

use PDO;

class Request {

    private $uri;
    private $method;
    private $params;
    private $routeParams;
    public function __construct() {

        $this->uri = strtok($_SERVER['REQUEST_URI'],'?');
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->params = $_REQUEST;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }


    public function setParams($name,$params)
	{
        
        return $_REQUEST[$name] = $params;
    }
    public function __set($key, $value):void
    {
        $this->setParams($key,$value);
    }
    public function __get($key){
        return $_REQUEST[$key];
    }



}