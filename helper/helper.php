<?php

function site_url($roter){

    return $_ENV['HOST'].$roter;

}

function asset_url($roter='')
{
    return site_url('assets/'.$roter);
}

function dd($varDump){

    echo '<pre style="border-left: 4px solid red; font-size: 18px; font-family: tahoma; padding: 12px; line-height: 1.6;">';
        var_dump($varDump);
    echo '</pre>';

}

function views($path, $data=[]){
    extract($data);
    $path = str_replace('.','/',$path);

    include BASEPATH . "/Views/$path.php";
}