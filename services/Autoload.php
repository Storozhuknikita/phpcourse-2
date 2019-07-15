<?php


class Autoload
{

    private $dir = [
      'models','services'
    ];


    public function loadClass($className){


        $file = str_replace(['App\\', '\\'], ['../', '/'], $className).'.php';

        //var_dump($file);
        if(file_exists($file)){
            include $file;
        }

    }
}