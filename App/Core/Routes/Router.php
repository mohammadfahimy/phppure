<?php

namespace App\Core\Routes;

use App\Core\Request;

class Router{

    private $request;
    private $routes;
    private $currentRoute;
    const BASE_CLASS_NAME = 'App\Controllers\\';

    public function __construct(){

        $request = new Request();
        $this->request = $request;
        $this->routes = Route::getRoutes();
        $this->currentRoute = $this->findeRoute($request);

    }

    public function findeRoute(Request $request)
    {
        

        foreach($this->routes as $route){

            if(!in_array($request->getMethod(), $route['methods'])){

                 continue;
            }

            if ( $this->regexMatch($route['uri'])){
                return $route;
            }
        }

        return null;
    }
    public function regexMatch($uri){

        $pattern = "/^". str_replace(['/','{','}'],['\/', '(?<','>[-%\w]+)'],$uri) ."$/";

        $result = preg_match($pattern,$this->request->getUri(),$matchs);
       
        
        foreach($matchs as $key => $value){
            if(!is_int($key)){

                $this->request->setParams($key , $value);

            }
        }


        if(!$result){
            return false;
        }
        return true;


    }

    public function runRouter()
    {
        #dispatch404

        if(is_null($this->currentRoute)){
            views('404');
            die();
        }
        #dispach405
        if($this->currentRoute === false){
            views('405');
            die();
        }

        $this->dispatch();
    }

    public function dispatch()
    {
        if(is_callable($this->currentRoute['action'])){
            $this->currentRoute['action']();
        }
        if(is_string($this->currentRoute['action'])){
            $arrayRoute = explode('@', $this->currentRoute['action']);
            $className = self::BASE_CLASS_NAME.$arrayRoute[0];
            $method = $arrayRoute[1];
            if(!class_exists($className)){
                throw new \Exception("class $className not Exist");
            }
            $class = new $className();
            if(!method_exists($class, $method)){
                throw new \Exception("class $method not Exist");
            }
            $class->$method();
        }
    }

}