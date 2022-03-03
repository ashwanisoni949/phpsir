<?php


spl_autoload_register(function($classname){
    echo 'readed from heap memory <br/>';
    require_once __DIR__."/../classes/{$classname}.php";
});