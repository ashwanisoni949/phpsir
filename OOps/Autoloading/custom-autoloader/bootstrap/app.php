<?php

$class_folder = scandir(dirname(__DIR__).'/class');
unset($class_folder[0],$class_folder[1]);

$allow_files = [
    'Student.php',
    'Manager.php',
];


foreach($class_folder as $file){
    if(in_array($file,$allow_files)){
        require_once dirname(__DIR__).'/class/'.$file;
    }
}

