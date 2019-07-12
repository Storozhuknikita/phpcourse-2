<?php


class Autoload
{

    private $dir = [
      'models','services'
    ];


    public function loadClass($className){


        foreach($this->dir as $dir){
            $file = "../{$dir}/{$className}.php";

            if(file_exists($file)){
                include $file;
                break;
            }
        }

    }
}