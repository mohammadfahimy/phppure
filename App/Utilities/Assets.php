<?php
namespace App\Utilities;

class Assets{


    public static function __callStatic($name, $arguments)
    {
        

             return ASSETURI . $name .'/'. implode(', ', $arguments).'.'.$name;

    }


}
