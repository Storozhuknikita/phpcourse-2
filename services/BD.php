<?php


class BD implements IBD
{

    public function find(string $sql) {

        echo $sql;
    }

    public function findAll(string $sql) {
        echo $sql;
    }

    public function getCount(){

    }
}