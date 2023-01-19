<?php
namespace App\Core\Routes;

class Route{


    private static $routes=[];

    public static function add($methods,$uri,$action=null,$middleware=[]){

        $methods= is_array($methods) ? $methods : [$methods];
        self::$routes[] = ['methods'=>$methods,'uri'=>$uri,'action'=>$action,'middleware'=>$middleware];

    }

    public static function get($uri,$action=null,$middleware=[]){
       return self::add('get',$uri,$action,$middleware);
    }
    
    public static function post($uri,$action=null,$middleware=[]){
         self::add(['post'],$uri,$action,$middleware);
    }


    public static function delete($uri,$action=null,$middleware=[]){
         self::add(['delete'],$uri,$action,$middleware);
    }


    public static function option($uri,$action=null,$middleware=[]){
         self::add(['option'],$uri,$action,$middleware);
    }


    public static function patch($uri,$action=null,$middleware=[]){
         self::add(['patch'],$uri,$action=null,$middleware);
    }

    public static function put($uri,$action=null,$middleware=[]){
         self::add(['put'],$uri,$action=null,$middleware);
    }


    public static function getRoutes(){

     return self::$routes;

    }


    


}